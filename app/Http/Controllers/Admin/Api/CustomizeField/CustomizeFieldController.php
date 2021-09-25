<?php

namespace App\Http\Controllers\Admin\Api\CustomizeField;

use App\CustomizeField;
use App\CustomizeFieldStudent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomizeFieldController extends Controller
{
    public function getCustomField()
    {
        $fields = CustomizeField::all();
        return response()->json($fields);
    }

    public function store(Request $request)
    {
       $classFields = $request['class_list'];
        $latin_name = CustomizeField::fieldLatinGenerates();
        $data = [
            'field_name' => $request['field_name'],
            'field_name_latin' => $latin_name,
            'field_type' => $request['field_type'],
            'field_model' => "info_students",
            'field_required' => $request['field_required'],
            'field_filter' => $request['field_filter'],
            'field_active' => $request['field_active'],
            'field_help' => $request['field_help'],
            'check_class_public' => $request['check_class_public'],
        ];
        $field= CustomizeField::create($data);
        foreach ($classFields as $item) {
            CustomizeFieldStudent::create([
                'field_id'=>$field->id,
                'class_id'=>$item['id'],
            ]);

        }
        return 'success';
    }

    public function isExistByLatinName(Request $request)
    {
        $ch = CustomizeField::query()->where('field_name_latin',$request['field_name_latin'])->first();
       if (! $ch ){
           return response()->json(['isExist'=>false]);
       }else{
           return response()->json(['isExist'=>true]);
       }
        // return $f['isExist'] = $ch == null ? false : true;
    }

    public function show($id)
    {
        if ($id){
            return $field = CustomizeField::query()->where('id',$id)->first();
        }else{
            return 'empty id';
        }
    }

    public function update($id,Request $request)
    {
        $field = CustomizeField::query()->where('id',$id)->first();
        if ($field) {
            $field->update($request->all());
        }
        return $field;
        //return $request->all();
    }

    public function destroy($id)
    {
        CustomizeField::destroy($id);
        return 'success';
    }


}
