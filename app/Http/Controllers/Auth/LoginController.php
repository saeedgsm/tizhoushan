<?php

namespace App\Http\Controllers\Auth;

use App\CustomField;
use App\Events\UserActivation;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\CustomFields;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers,CustomFields;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {

        if (Auth::user()->level === "admin") {
           // return '/admin/dashboard';
            return route('admin.dashboard');
        }

        if (Auth::user()->level === "student") {
           // if (Auth::user()->email == null || Auth::user()->phone == null) {
                //return redirect(route('student.panel.edit'))->with('warning', 'برای برای ادامه لطفا آدرس ایمیل و تلفن همراه خود را تایید کنید!');
                //return '/student/panel/edit';}
            return route('student.dashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }

    public function showLoginForm(Request $request)
    {
        return view('auth.v2.login_register', compact('request'));
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $user = User::where('usercode', $request->input('inId'))
            ->orWhere('phone', $request->input('inId'))
            ->orWhere('email', $request->input('inId'))
            ->first();
        if (!$user) {
            return back()->withErrors('کد کاربری وارد شده اشتباه است!');
        }
        if (Hash::check($request['password'], $user->password, []) == false) {
            return back()->withErrors('رمز عبور وارد شده اشتباه می باشد!');
        } else {
          /*   if ($user->phone == null){
                return redirect(route('user.insert.phone.form',['pc' => $user->private_code]))->with('warning', 'شماره موبایل خود را جهت ادامه وارد کنید!');
            } */
            /* if ($user->level == 'student') {
                if ($user->phone == null) {
                    return redirect(route('user.insert.phone.form', ['pc' => $user->private_code]))->with('warning', 'شماره موبایل خود را جهت ادامه وارد کنید!');
                    //return view('authentication.insert_phone',compact('user'))->with('warning','شماره موبایل خود را جهت ادامه وارد کنید!');
                } elseif ($user->phone_verified_at == null) {
                    //return redirect(route('user.check.phone.exist', ['pc' => $user->private_code]))->with('warning', 'کاربر گرامی شماره موبایل شما قبلا ثبت شده است! ');
                }
            } */
        }
        //dd($request);
       /* auth()->loginUsingId($user->id);
        return $this->redirectTo();*/

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }


        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function resend()
    {
        $user = User::where('id', Request()->ex)->first();
        return view('auth.resend', compact('user'));
    }

    public function resendCode(Request $request, User $user)
    {
        // event(new UserActivationEmail($user) );
        event(new UserActivation($user));
        return redirect(route('confirm.code.form'));
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function username()
    {
        $login = request()->input('inId');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'usercode';
        request()->merge([$field => $login]);
        return $field;
    }

    public function insertPhoneForm($pc)
    {
        /*$custom = CustomField::query()->where('table_task','update_phone_info')->first();
        if (! empty($custom)){
           $colsDef = $custom->field_list;
           $cols = $this->exportArray($colsDef);
        }*/
        return view('auth.v2.phone', compact('pc'));
    }

    public function checkPhone(Request $request, $pc)
    {
        //dd(url()->previous());
        $request->validate([
            'phone' => ['required', 'numeric', 'digits:11', 'unique:users'],
        ]);
         $user = User::where('private_code', $pc)->first();

        if (!$user) {
            return back();
        }

        $oldCode = $user->activeAccountCodes()->latest()->first();
        //dd($oldCode);
        if ($oldCode) {
            if ($oldCode->expire > Carbon::now()) {
                $user->update(['phone' => $request['phone']]);
                return redirect(route('register.confirm.code.form'))->with('warning', 'کد تایید شما قبلا ارسال شده است! در صورت عدم دریافت کد بعد از 15 دقیقه دوباره امتحان کنید!');
            }
        }
        $user->update(['phone' => $request['phone']]);
        event(new UserActivation($user));
        return redirect(route('register.confirm.code.form'))->with('success', 'کد تایید با موفقیت ارسال گردید!');

    }

    public function checkPhoneForm($pc)
    {
        $user = User::where('private_code',$pc)->first();
        if (!$user){
            return redirect(route('home'));
        }elseif ($user->phone_verified_at != null){
            return redirect(route('home'));
        }
        return view('auth.v2.checkPhone',compact('pc','user'))->with('warning','شماره موبایل قبلا ثبت شده است، لطفا شماره موبایل خود را تایید کنید!');
    }
}
