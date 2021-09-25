<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\InfoCadre;
use App\InfoTeacher;
use App\Traits\OptionTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CadreController extends Controller
{
    use OptionTrait;

    public function index(Request $request)
    {
        $sortBy = 'id';
        $orderBy = 'desc';
        $perPage = 20;
        $level = null;
        $q = null;

        if ($request->has('level')) $level = $request->query('level');
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
//dd($level);
        if ($request->has('level')){
            $users = User::search($q)
                ->whereIn('level',['agency','teacher','admin'])
                ->where('level',$level)
                ->where('id','!=',auth()->user()->id)
                ->orderBy($sortBy,$orderBy)
                ->paginate($perPage);
        }else{
            $users = User::whereIn('level',['agency','teacher','admin'])
                ->paginate($perPage);
        }

        return view('panel.admin.cadres.all',compact('sortBy','orderBy','perPage','level','q',
            'users'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('panel.admin.cadres.create',compact('roles'));
    }

    public function store(TeacherRequest $request)
    {
        $randomString = $this->createUniquePrivateCode(8);
        $userData  = [
            'private_code'=>$randomString,
            'level'=>$request['level'],
            'first_name'=>$request['first_name'],
            'last_name'=>$request['last_name'],
            'email'=>$request['email'],
            'phone'=>$request['phone'],
            'password'=>bcrypt($request['password']),
            'block'=>$request['block'],
        ];
        $user = User::create($userData);
        $user->assignRole($request->input('roles'));
        $info =[
            'user_id'=>$user->id,
            'state_id'=>$request['state_id'],
            'city_id'=>$request['city_id'],
        ];
        InfoCadre::create($info);
        return redirect(route('admin.cadres.index',['level'=>$request['level']]))->with('success','اطلاعات کادر با موفقیت ثبت گردید!');
    }

    public function edit(User $cadre)
    {
        $info=InfoCadre::where('user_id',$cadre->id)->first();
        $states = DB::table('states')->orderBy('name','asc')->get();
        $cities = DB::table('cities')->where('state_id',$info->state_id)->orderBy('name','asc')->get();

        $roles = Role::pluck('name','name')->all();
        $userRole = $cadre->roles->pluck('name','name')->all();

        return view('panel.admin.cadres.edit',compact('cadre','states','cities','info','userRole','roles'));
    }

    public function update(TeacherRequest $request, User $cadre)
    {
        if ($request['email']){
            $newEmail = $request['email'];
        }else{
            $newEmail=$cadre->email;
        }

        if ($request['phone']){
            $newPhone = $request['phone'];
        }else{
            $newPhone=$cadre->phone;
        }

        if ($request['password']){
            $newPassword = bcrypt($request['password']);
        }else{
            $newPassword = $cadre->password;
        }

        $userData  = [
            'first_name'=>$request['first_name'],
            'last_name'=>$request['last_name'],
            'email'=>$newEmail,
            'phone'=>$newPhone,
            'password'=>$newPassword,
            'block'=>$request['block'],
        ];

        $info = InfoCadre::where('user_id',$cadre->id)->first();
        $info->update([
            'state_id'=>$request['state_id'],
            'city_id'=>$request['city_id'],
        ]);
        $cadre->update($userData);
        $cadre->assignRole($request->input('roles'));
        return redirect(route('admin.cadres.index',['level'=>$request['level']]))->with('success','اطلاعات کاربر با موفقیت ویرایش گردید!');
    }

    public function destroy(User $cadre)
    {
        $cadre->delete();
        return redirect(route('admin.cadres.index'))->with('success','کاربر مورد نظر با موفقیت حذف گردید!');
    }
}
