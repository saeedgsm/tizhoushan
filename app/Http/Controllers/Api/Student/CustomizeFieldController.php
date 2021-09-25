<?php


namespace App\Http\Controllers\Api\Student;


use App\CustomizeField;
use App\CustomizeFieldStudent;
use App\CustomizeFieldValue;
use App\Http\Controllers\Controller;
use App\User;

class CustomizeFieldController extends Controller
{
    public function fields($userId)
    {
        $st = CustomizeField::query()->where('field_model', 'info_students')
            ->where('field_active', 1)->get();

        $user=User::find($userId);

        $BC = $user->studentBaseClass()->first();
        $existTags = ['checkbox', 'select', 'radio'];
        $tags = [];
        foreach ($st as $item) {
            if ($item->check_class_public == 1){
                $vals = [];
                if (in_array($item->field_type, $existTags)) {
                    $check_values = $item->fieldOptions;
                    if ($check_values->isNotEmpty()) {
                        foreach ($check_values as $check_value) {
                            $vals[] = [
                                'option' => $check_value->option_value,
                            ];
                        }
                    }

                }
                $tags[] = [
                    'field_name' => $item->field_name,
                    'field_name_latin' => $item->field_name_latin,
                    'field_type' => $item->field_type,
                    'field_length' => $item->field_length,
                    'field_default_value' => $item->field_default_value,
                    'field_required' => $item->field_required,
                    'field_help' => $item->field_help,
                    'values' => $vals,
                ];
            }else{
                $studentField=CustomizeFieldStudent::query()->where('field_id',$item->id)->where('class_id',$BC->class_id)->first();
                if ($studentField){
                    $vals = [];
                    if (in_array($item->field_type, $existTags)) {
                        $check_values = $item->fieldOptions;
                        if ($check_values->isNotEmpty()) {
                            foreach ($check_values as $check_value) {
                                $vals[] = [
                                    'option' => $check_value->option_value,
                                ];
                            }
                        }

                    }
                    $tags[] = [
                        'field_name' => $item->field_name,
                        'field_name_latin' => $item->field_name_latin,
                        'field_type' => $item->field_type,
                        'field_length' => $item->field_length,
                        'field_default_value' => $item->field_default_value,
                        'field_required' => $item->field_required,
                        'field_help' => $item->field_help,
                        'values' => $vals,
                    ];
                }
            }


        }
        return $tags;
    }

    public function fieldValues($user_id)
    {
        $fields = CustomizeFieldValue::query()->where('user_id', $user_id)->get();
        $data = [];
        foreach ($fields as $field) {
            $cf = CustomizeField::query()->where('field_name_latin', $field->field_name)->first();
            if ($cf) {
                if ($cf->field_type === 'text' || $cf->field_type === 'number' || $cf->field_type === 'textarea') {
                    $data[] = [
                        'value' => $field->value,
                        'field_id' => $field->field_name,
                        'type' => $cf->field_type
                    ];
                } elseif ($cf->field_type === 'radio' || $cf->field_type === 'checkbox') {
                    $options = $cf->fieldOptions;
                    $ii = 0;
                    foreach ($options as $option) {
                        $ii++;
                        if ($option->option_value === $field->value) {
                            $field_id = $field->field_name . $ii;
                            break;
                        }
                    }
                    $data[] = [
                        'value' => $field->value,
                        'field_id' => $field_id,
                        'type' => $cf->field_type
                    ];
                } elseif ($cf->field_type === 'select') {
                    $options = $cf->fieldOptions;
                    foreach ($options as $option) {
                        if ($option->option_value === $field->value) {
                            $field_id = $field->field_name;
                            break;
                        }
                    }
                    $data[] = [
                        'value' => $field->value,
                        'field_id' => $field_id,
                        'type' => $cf->field_type
                    ];
                }
            }
        }
        return response()->json($data);
        // return $user_id;
    }
}
