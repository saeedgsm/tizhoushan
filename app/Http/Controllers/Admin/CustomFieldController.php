<?php

namespace App\Http\Controllers\Admin;

use App\CustomField;
use App\Http\Controllers\Controller;
use App\Traits\CustomFields;
use Illuminate\Http\Request;

class CustomFieldController extends Controller
{
    use CustomFields;

    public function index()
    {
        $fields = CustomField::query()->paginate(20);
        return view('panel.admin.customFields.all',compact('fields'));
        /*$fields = CustomField::all()->toArray();
        return array_reverse($fields);*/
    }

    public function create()
    {
        return view('panel.admin.customFields.create');
    }

    public function store(Request $request)
    {
       /* $inputs = $request->except(['field_list']);
        $cols = $request['field_list'];
        $array_cols = explode('|',$cols);
        $keys=[];
        foreach ($array_cols as $col){
            $keys[$col] = 1;
        }
        $inputs['field_list']=$keys;*/
       // return $inputs;

        CustomField::create($request->all());

        return redirect(route('admin.fields.index'))->with('success','اطلاعات با موفقیت ثبت گردید!');
    }

    public function edit(CustomField $field)
    {
        $colsDef = $field->field_list;
        $cols = $this->exportArray($colsDef);
        return view('panel.admin.customFields.edit',compact('field','cols'));
    }

    public function update(Request $request, CustomField $field)
    {
        $fields = $request->except(['_token','_method']);
        $cc='';
        $x = 1;
        $length = count($fields);
        foreach ($fields as $key => $val) {
            if($x === $length){
                $cc .= $key . ':' . $val;
            }else{
                $cc .= $key . ':' . $val . '|';
            }
            $x++;
        }
        $input['field_list']=$cc;
        $field->update($input);
        return redirect(route('admin.fields.index'))->with('success','اطلاعات با موفقیت ویرایش گردید!');

    }
}
