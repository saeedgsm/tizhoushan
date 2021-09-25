<?php

namespace App\Http\Controllers\Auth;

use App\ActiveAccountCode;
use App\Events\ActivationUser;
use App\Events\UserActivation;
use App\Http\Controllers\Controller;
use App\InfoStudent;
use App\Providers\RouteServiceProvider;
use App\SmsTool;
use App\Traits\OptionTrait;
use App\Traits\RegistrationFeeTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers,OptionTrait,RegistrationFeeTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
  //  protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        //return redirect(route('apanel'))
        return route('register.confirm.code.form');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            //'usercode' => ['required', 'string','min:5','max:255' , 'regex:/(^([a-zA-Z]+)(\d+)?$)/u', 'unique:users'],
            'phone' => ['required', 'string', 'digits:11', 'unique:users'],
          //  'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:4'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $randomString=$this->createUniquePrivateCode(8);
        $userCode = $this->createUniqueUserCode();

        $user = User::create([
            'private_code' => $randomString,
            'level' => 'student',
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'usercode' => $userCode,
            'phone' => $data['phone'],
           // 'email' => $data['email'],
            'userpass' => $data['password'],
            'password' => Hash::make($data['password']),
        ]);

        InfoStudent::create([
            'user_id'=>$user->id,
        ]);

        return $user;
    }

    public function showRegistrationForm()
    {
        return view('authentication.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $sms_status = SmsTool::first();
        if ($sms_status->status==0){
            auth()->loginUsingId($user->id);
            return $request->wantsJson()
                ? new JsonResponse([], 201)
                : redirect(route('student.register.select'));
        }
       // $this->guard()->login($user);
        event(new UserActivation($user));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath($request));
    }

    public function redirectPath(Request $request)
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    public function confirmRegisterCodeForm()
    {
        return view('auth.v2.verify_sms');
    }

    public function getCode(Request $request)
    {
        $activationCode = ActiveAccountCode::whereCode($request->scode)->first();
        if(! $activationCode) {
            return back()->with('error','کد وارد شده اشتباه است');
        }

        if($activationCode->expire < Carbon::now()) {
            return back()->with('error','تاریخ مصرف کد گذشته است');
        }

        if($activationCode->used == true) {
            return back()->with('error','کد وارد شده قبلا استفاده شده است');
        }

        $activationCode->user()->update([
            'active' => 1,
            'phone_verified_at'=>Carbon::now()
        ]);

        $activationCode->update([
            'used' => true
        ]);

        auth()->loginUsingId($activationCode->user->id);
        $activationCode->delete();
        if (auth()->user()->level == 'admin'){
            return redirect(route('admin.panel'))->with('success','حساب شما فعال شد');
        }elseif (auth()->user()->level == 'student') {
            return redirect(route('student.register.select'))->with('success','حساب شما فعال شد. لطفا اطلاعات خود را کامل پر کنید!');
        }

    }


}
