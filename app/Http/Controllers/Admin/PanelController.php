<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\OptionController;
use Illuminate\Http\Request;

class PanelController extends OptionController
{
    public function index()
    {
        return view('panel.admin.panel.show');
    }

    public function edit()
    {
        $user = auth()->user();
        return view('panel.admin.panel.edit',compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([

            'first_name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'phone' => ['nullable', 'numeric', 'digits:11', 'unique:users'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:4', 'confirmed'],
        ]);
        $user = auth()->user();

        $file = $request->file('avatar');
        $userInfo = $request->except('password','email','phone','avatar');

        if ($file){
            if (file_exists(asset($user->avatar)))
                unlink($user->avatar);
            $userInfo['avatar'] = $this->uploadImage($file,'avatars');
        }else{
            $userInfo['avatar'] = $user->avatar;
        }

        $phone = $request['phone'];
        if ($phone){
            $userInfo['phone'] = $phone;
        }else{
            $userInfo['phone'] = $user->phone;
        }

        $email = $request['email'];
        if ($email){
            $userInfo['email'] = $email;
        }else{
            $userInfo['email'] = $user->email;
        }

        $password = $request['password'];
        if ($password){
            $userInfo['password'] = bcrypt($password);
        }else{
            $userInfo['password'] = $user->password;
        }

        $user->update($userInfo);

        return redirect(route('admin.panel'))->with('success','اطلاعات کاربر با موفقیت ویرایش شد');
    }
}
