<?php

namespace App\Http\Controllers\Admin;

use App\Azmoon;
use App\AzmoonAdvancePorseshnameh;
use App\AzmoonPorseshnameh;
use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\PorseshnamehRequest;
use Illuminate\Http\Request;

class AzmoonPorseshnamehController extends Controller
{
    public function create(Request $request)
    {
        $azmoon = Azmoon::find($request['azmoon']);
        $p= AzmoonPorseshnameh::where('azmoon_id',$azmoon->id)->first();
        if ($p){
            return back()->with('warning','کلید سوالات قبلا ثبت شده است!');
        }
        $soal = $azmoon->soal()->first();
        return view('panel.admin.azmoonPoreshnamehs.create',compact('azmoon','soal'));
    }

    public function store(Request $request)
    {
        $answers = $request->except(['_token','_method','azmoon_id','number_of_question']);
        $lres=null;
        $array=array();
        foreach ($answers as $KEY=>$i){
            $array[]=$KEY . ':' . $i;
            //$lres = $lres . $KEY . ':' . $i . ','; old way
        }
        $lres=implode(",",$array);

        $inputs['azmoon_id'] = $request['azmoon_id'];
        $inputs['number_of_question'] = $request['number_of_question'];
        $inputs['correct_key'] =$lres;
        AzmoonPorseshnameh::create($inputs);
        $azmoon=Azmoon::where('id',$request['azmoon_id'])->first();
        return redirect(route('admin.azmoons.show',$azmoon))->with('success','با موفقیت گزینه سوال ثبت گردید! ');
    }

    public function destroy(AzmoonPorseshnameh $porseshnameh)
    {
        $porseshnameh->delete();
        return redirect(url()->previous())->with('success','با موفقیت حذف گردید!');
    }


    /// advanced

    public function insertAdvanceSoal(Request $request)
    {
        $azmoon = Azmoon::query()->where('id',$request['azmoon_id'])->first();
        $book = Book::query()->where('id',$request['book_id'])->first();
        return view('panel.admin.azmoonPoreshnamehs.create_advanced',compact('request','azmoon','book'));
    }

    public function StoreAdvancedSoal(Request $request)
    {
        $answers = $request->except(['_token','_method','azmoon_id','number_of_question','book_id']);
        $lres=null;
        $array=array();
        foreach ($answers as $KEY=>$i){
            $array[]=$KEY . ':' . $i;
        }
        $lres=implode(",",$array);

        $inputs['azmoon_id'] = $request['azmoon_id'];
        $inputs['book_id'] = $request['book_id'];
        $inputs['number_of_question'] = $request['number_of_question'];
        $inputs['correct_key'] =$lres;
        AzmoonAdvancePorseshnameh::create($inputs);
        $azmoon=Azmoon::where('id',$request['azmoon_id'])->first();
        return redirect(route('admin.azmoons.show',$azmoon))->with('success','با موفقیت گزینه سوال ثبت گردید! ');
    }
}
