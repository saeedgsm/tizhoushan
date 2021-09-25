<?php

namespace App\Http\Controllers\Admin\Api\Azmoon;

use App\Azmoon;
use App\AzmoonPorseshnameh;
use App\AzmoonSoalatFile;
use App\Http\Controllers\Controller;
use App\Traits\UploaderFile;
use Illuminate\Http\Request;

class NormalPorseshnamehFileController extends Controller
{
    use UploaderFile;
    public function index($azmoonId)
    {
        $files=AzmoonSoalatFile::query()->where('azmoon_id',$azmoonId)->latest()->get();
        $data=[];
        if ($files->isNotEmpty()) {
            foreach ($files as $file) {
                $data[] = [
                    'id'=>$file->id,
                    'azmoon_id'=>$file->azmoon_id,
                    'title'=>$file->title == '' ? 'بی نام' : $file->title,
                    'pdf_file'=>asset($file->pdf_file),
                    'image'=>asset($file->image),
                ];
            }
        }
        return response()->json(['files'=>$data]);
    }

    public function imageUpload(Request $request)
    {
        $input = [
            'azmoon_id'=>$request->input('azmoon_id'),
            'title'=>$request->input('file_name'),
        ];
        $file = $request->file('file');
        if ($file) {
            $input['image'] = $this->uploadImage($file,'azmoon_soal');
        }

        AzmoonSoalatFile::create($input);
        return response('success');

    }

    public function soalPoreshnameh($id)
    {
        $azmoon = Azmoon::query()->where('id',$id)->first();
        $soal = $azmoon->soal;
        $soals = AzmoonPorseshnameh::query()->where('azmoon_id',$id)->first();
        return response(['soal'=>$soal,'soals'=>$soals]);
    }

    public function soalPoreshnamehStore(Request $request)
    {
        try {
            $keys = AzmoonPorseshnameh::query()->where('azmoon_id',$request->input('azmoon_id'))->first();
            if ($keys) {
                $keys->update([
                    'number_of_question'=>$request['number_of_question'],
                    'correct_key'=>$request['correct_key'],
                ]);
                $msg_type='success';
                $msg="کلید سوالات با موفقیت بروزرسانی شد!";
            }else{
                AzmoonPorseshnameh::create($request->all());
                $msg_type='info';
                $msg="کلید سوالات با موفقیت ثبت گردید!";
            }

            return response(['code'=>$msg_type,'message'=>$msg,'error_info'=>'']);
        } catch (\Throwable $th) {
            $msg_type='error';
            $msg="در ثبت اطلاعات مشکل بوجود آمد!!";
            return response(['code'=>$msg_type,'message'=>$msg,'error_info'=>$th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $file = AzmoonSoalatFile::query()->where('id',$id)->first();
        if ($file) {
            if (file_exists(asset($file->image)))
            unlink($file->image);

        if (file_exists(asset($file->pdf_file)))
            unlink($file->pdf_file);
        $file->delete();
        }
        return response('success');
    }
}
