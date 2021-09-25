<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class LoaderController extends Controller
{
    public function dashboard()
    {
        return view('panel.admin.dashboard');
    }
}
