<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LoaderController extends Controller
{
    public function dashboard()
    {
        return view('panel.admin.dashboard');
    }
}
