<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class LoaderController extends Controller
{
    public function dashboard()
    {
        $studentCount = User::where('level','student')->count();
        return view('panel.teacher.dashboard',compact('studentCount'));
    }
}
