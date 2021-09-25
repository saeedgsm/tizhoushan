<?php


namespace App\Http\Controllers\Api;


use App\CustomField;
use App\Http\Controllers\Controller;

class CustomFieldController extends Controller
{
    public function getCustomField(): array
    {
       return $fields = CustomField::query()->get()->toArray();
       // return response()->json($fields);
    }
}