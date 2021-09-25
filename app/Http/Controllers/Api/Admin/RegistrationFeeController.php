<?php


namespace App\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use App\RegistrationFee;
use Illuminate\Http\Request;


class RegistrationFeeController extends Controller
{
    public function all()
    {
        $fees = RegistrationFee::all();
        $all=[];
        foreach ($fees as $fee){
            $all[]=[
                'id'=>$fee->id,
                'base_id'=>$fee->base->id,
                'base_name'=>$fee->base->base_title,
                'status'=>$fee->status,
                'cost'=>$fee->cost,
                'desc'=>$fee->desc,

            ];
        }
        return response()->json($all);
    }

    public function edit($id)
    {
        $registration = RegistrationFee::query()->where('id',$id)->first();
        return response()->json($registration);
    }

    public function update($id,Request $request)
    {
        $reg = RegistrationFee::query()->where('id',$id)->first();
        $reg->update($request->all());
        return 'success';
    }
}