<?php


namespace App\Traits;

use App\CustomizeField;
use App\CustomizeFieldStudent;

trait CustomFields
{
    public function exportArray($list)
    {
        $colArray = explode('|',$list);
        $cols = array();
        foreach ($colArray as $index){
            $each = explode(':',$index);
            $cols[$each[0]]=$each[1];
        }
        return $cols;
    }

    public function publicHeaders()
    {
        $heads=[];
        $all_public = CustomizeField::query()
            ->where('field_active',1)
            ->where('check_class_public',1)
            ->get();
        if ($all_public->isNotEmpty()){
            foreach ($all_public as $public){
                $heads[]=[
                    'label'=>$public->field_name,
                    'field'=>$public->field_name_latin,
                ];
            }
        }
        return $heads;
    }

    public function fetchHeaderColumns($classes)
    {
        $heads=[];
        if ($classes->isNotEmpty()){
            foreach ($classes as $class) {
                $student_fields = CustomizeFieldStudent::query()
                    ->where('class_id',$class->class_id)->get();
                if ($student_fields->isNotEmpty()){
                    foreach ($student_fields as $st_field){
                        $field = CustomizeField::query()
                            ->where('field_active',1)
                            ->where('id',$st_field->field_id)
                            ->first();
                        if ($field){
                            $heads[]=[
                                'label'=>$field->field_name,
                                'field'=>$field->field_name_latin,
                            ];
                        }
                    }
                }
            }
        }
        return $heads;
    }
}
