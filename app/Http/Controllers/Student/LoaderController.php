<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Traits\OptionTrait;
use Illuminate\Http\Request;

class LoaderController extends Controller
{
    use OptionTrait;

    public function dashboard()
    {
        return view('panel.student.dashboard');
    }

    public function iframe()
    {
        return view('panel.student.iframe');
    }
}
