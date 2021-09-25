<?php


namespace App\Http\Controllers\Admin\Api\TariffBase;


use App\Http\Controllers\Controller;
use App\TariffBase;
use Illuminate\Http\Request;

class TariffBaseController extends Controller
{
    public function index()
    {
        $tariffs = TariffBase::all();
        return response()->json($tariffs);
    }

    public function store(Request $request)
    {
        $baseIds = $request['bases_ids'];
        $ids="";
        $l=0;
        foreach ($baseIds as $baseId){
            if ($l==0){
                $ids .= $baseId['id'];
            }else{
                $ids .= ",". $baseId['id'];
            }

            $l++;
        }

        $inputs = $request->except('bases_ids');
        $inputs['tariff_bases']=$ids;
        return TariffBase::create($inputs);
    }

    public function destroy($id)
    {
         TariffBase::destroy($id);
         return 'success';
    }
}