<?php

namespace App\Http\Controllers\Admin\Api\Azmoon;

use App\Azmoon;
use App\AzmoonClass;
use App\EducationalClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AzmoonClassController extends Controller
{
    public function index($azmoonId)
    {
        $base_class = AzmoonClass::query()->where('azmoon_id', $azmoonId)->get();
        $class_list = [];
        if ($base_class->isNotEmpty()) {
            foreach ($base_class as $item) {
                $class = EducationalClass::query()->where('id', $item->educational_class_id)->first();
                $list = [
                    'id' => $item->id,
                    'class_id' => $class->id,
                    'class_title' => $class->class_title,
                    'base_title' => $class->educationBase->base_title,
                    'base_id' => $class->educationBase->id,
                ];

                array_push($class_list, $list);
            }
        }

        return response(['classes' => $class_list]);
    }

    /** @test */
    public function update(Request $request)
    {
        $azmoon=Azmoon::find($request['azmoon_id']);

        foreach ($request['class_list'] as $item) {
            $check = $azmoon->azmoonClasses->where('educational_class_id',$item['id'])->first();
            if (!$check) {
                //return "not";
                AzmoonClass::create([
                    'azmoon_id'=>$azmoon->id,
                    'educational_class_id'=>$item['id']
                ]);
            }
        }
        return response('success');
    }


    public function destroy($azmoonClassId)
    {
        $azmoonClass = AzmoonClass::find($azmoonClassId);
        $azmoonClass->delete();
        return response('success');
    }
}
