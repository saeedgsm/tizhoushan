<?php


namespace App\Http\Controllers\Admin\Api\CustomizeField;

use App\CustomizeFieldOption;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class FieldOptionController extends Controller
{
    public function index($fieldId)
    {
        $options = CustomizeFieldOption::query()->where('field_id',$fieldId)->latest()->get();
        return response()->json($options);
    }

    public function store(Request $request)
    {
        $option = CustomizeFieldOption::create($request->all());
        return response()->json($option);
        //return $request->all();
    }

    public function edit($optionId)
    {
        if ($optionId){
            $option = CustomizeFieldOption::query()->where('id',$optionId)->first();
            return response()->json($option);
        }else{
            return 'empty';
        }
    }

    public function update($optionId, Request $request)
    {
        if ($optionId){
            $option = CustomizeFieldOption::query()->where('id',$optionId)->first();
            $option->update($request->all());
            return response()->json($option);
        }else{
            return 'empty';
        }
    }

    public function destroy($id)
    {
        CustomizeFieldOption::destroy($id);
        return 'success';
    }
}