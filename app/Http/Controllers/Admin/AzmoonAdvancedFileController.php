<?php

namespace App\Http\Controllers\Admin;

use App\Azmoon;
use App\AzmoonAdvancedFile;
use App\Http\Controllers\Controller;
use App\Traits\UploaderFile;
use Illuminate\Http\Request;

class AzmoonAdvancedFileController extends Controller
{
    use UploaderFile;

    public function create(Azmoon $azmoon)
    {
        $azmoonBooks = $azmoon->azmoonBooks;
        return view('panel.admin.azmoonSoalatFiles.advancedPorseshnameh',compact('azmoon','azmoonBooks'));
    }

    public function store(Request $request, Azmoon $azmoon)
    {
        $request->validate([
            'book_id'=>'required',
            'title'=>'required',
            'image'=>'required|mimes:jpg,bmp,png',
            'pdf_file'=>'nullable|mimes:pdf'
        ]);
        $image = $request->file('image');
        $pdf = $request->file('pdf_file');
        $inputs = $request->except(['pdf_file','image']);
        $inputs['azmoon_id'] = $azmoon->id;
        if ($image){
            $inputs['image'] = $this->UploadSoalFiles($image,'soalat');
        }
        if ($pdf){
            $inputs['pdf_file'] = $this->UploadSoalFiles($pdf,'soalat');
        }
        AzmoonAdvancedFile::create($inputs);
        return redirect(url()->previous())->with('success','فایل با موفقیت آپلود گردید!');
    }

    public function destroy(AzmoonAdvancedFile $advancedFile)
    {
        if (file_exists(asset($advancedFile->image)))
            unlink($advancedFile->image);

        if (file_exists(asset($advancedFile->pdf_file)))
            unlink($advancedFile->pdf_file);
        $advancedFile->delete();
        return redirect(url()->previous())->with('success','فایل با موفقیت حذف گردید');
    }
}
