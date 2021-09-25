<?php


namespace App\Http\Controllers\Admin\Api\Education;


use App\EducationalBase;
use App\Http\Controllers\Controller;

class EducationBaseController extends Controller
{
    public function fetchBase($baseId)
    {
        $base = EducationalBase::find($baseId);
        return response()->json($base);
    }
}
