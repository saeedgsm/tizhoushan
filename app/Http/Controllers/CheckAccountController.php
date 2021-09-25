<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckAccountController extends Controller
{
    public function check()
    {

        return view('checkAccount');
    }

    public function checkAccount(Request $request)
    {
        $usersA = DB::table('karbaran')->where('usercode',$request['username'])->where('pass',$request['password'])->first();
        if ($usersA){
            dd('find');
        }else{
            dd('Not find!');
        }
    }

    public function copy()
    {
        $skip=0;
        while (true){
            //$users = DB::table('karbaran')->orderBy('id','asc')->skip($skip)->take(10)->get();
            $users = DB::table('karbaran')->orderBy('id','asc')
                ->where('id','>=',2635)
                ->skip($skip)->take(10)->get();
            $skip+=10;
            foreach ($users as $user){
                echo $user->id;
                echo '<br>';
                User::create([
                    'level'=>'student',
                    'first_name'=> $user->getname,
                    'last_name'=> $user->getfamily,
                    'username'=> $user->usercode,
                    'password'=> bcrypt($user->pass),
                ]);
            }

        }


       // $NUsers = User::all();
        //return $NUsers->count();

    }

}
