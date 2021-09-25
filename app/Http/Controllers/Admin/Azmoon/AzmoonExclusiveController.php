<?php

namespace App\Http\Controllers\Admin\Azmoon;

use App\Azmoon;
use App\AzmoonExclusive;
use App\EducationalBase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AzmoonExclusiveController extends Controller
{
    public function index(Request $request)
    {
        $azmoon = Azmoon::query()->where('id', $request['id'])->first();
        $exclusives = AzmoonExclusive::query()->where('azmoon_id', $azmoon->id)->get();
        return view('panel.admin.azmoon.exclusives.all', compact('azmoon', 'exclusives'));
    }

    public function create(Request $request)
    {
        $azmoon = Azmoon::query()->where('id', $request['id'])->first();
        $bases = EducationalBase::query()->orderBy('id','asc')->get();
        return view('panel.admin.azmoon.exclusives.create',compact('azmoon','bases'));
    }

    public function store(Request $request)
    {
        $in = $request->except('classes');
        $exc = AzmoonExclusive::where('azmoon_id',$request['azmoon_id'])->where('base_id',$request['base_id'])->first();
        if ($exc){
            if ($exc->classes != null || $exc->classes != ''){
                $inc = $exc->classes . ',' . $request['classes'];
            }else{
                $inc = $request['classes'];
            }
            $exc->update(['classes'=>$inc]);
        }else{
            $in['classes'] = $request['classes'];
            AzmoonExclusive::create($in);
        }

        $azmoon = Azmoon::where('id',$request['azmoon_id'])->first();
        return redirect(route('admin.exclusives.index',['id'=>$azmoon->id]))->with('success','با موفقیت ثبت گردید!');
    }

    public function destroy(AzmoonExclusive $exclusife)
    {

        $exclusife->delete();
        return back()->with('success','با موفقیت حذف گردید!');
    }
}
