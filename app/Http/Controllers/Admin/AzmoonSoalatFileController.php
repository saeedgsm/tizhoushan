<?php

namespace App\Http\Controllers\Admin;

use App\Azmoon;
use App\AzmoonSoalatFile;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AzmoonSoalatFileController extends Controller
{
    public function create(Request $request)
    {
        $azmoon = Azmoon::find($request['azmoon']);
        return view('panel.admin.azmoonSoalatFiles.create',compact('azmoon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'image'=>'required|mimes:jpg,bmp,png',
            'pdf_file'=>'nullable|mimes:pdf'
        ]);
        $image = $request->file('image');
        $pdf = $request->file('pdf_file');
        $inputs = $request->except(['pdf_file','image']);
        if ($image){
            $inputs['image'] = $this->UploadSoalFiles($image,'soalat');
        }
        if ($pdf){
            $inputs['pdf_file'] = $this->UploadSoalFiles($pdf,'soalat');
        }
        AzmoonSoalatFile::create($inputs);
        return redirect(url()->previous())->with('success','فایل با موفقیت آپلود گردید!');
    }

    public function UploadSoalFiles($file, $folder)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;

        $filename = Carbon::now()->timestamp. '.' .$file->getClientOriginalExtension();
        $dir = 'upload/'. $folder . '/'. $year . '/' . $month .'/'. $day .'/';
        $file->move(public_path($dir),$filename);
        return $dir . $filename;
    }

    public function destroy(AzmoonSoalatFile $azmoonSoalatFile)
    {
        if (file_exists(asset($azmoonSoalatFile->image)))
            unlink($azmoonSoalatFile->image);

        if (file_exists(asset($azmoonSoalatFile->pdf_file)))
            unlink($azmoonSoalatFile->pdf_file);
        $azmoonSoalatFile->delete();
        return redirect(url()->previous())->with('success','فایل با موفقیت حذف گردید');
    }
}
