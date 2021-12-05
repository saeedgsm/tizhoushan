<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Traits\OptionTrait;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use OptionTrait;


    public function index()
    {
        $base = auth()->user()->studentBaseClass->educationBase;
        //$base = EducationalBase::find(6);
        $books = $base->books;
        return view('panel.student.books.all',compact('base','books'));
    }
}
