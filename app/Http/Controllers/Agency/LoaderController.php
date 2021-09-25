<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class LoaderController extends Controller
{
    public function dashboard()
    {
        $studentCount = User::where('level','student')->count();
        return view('panel.agency.dashboard',compact('studentCount'));
    }
}
