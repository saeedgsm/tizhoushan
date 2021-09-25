<?php

namespace App\Http\Controllers\Admin;

use App\Azmoon;
use App\AzmoonSoalatFile;
use App\AzmoonSoalBSoal;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AzmoonSoalbsoalController extends Controller
{
    public function create(Request $request)
    {
        $azmoon = Azmoon::find($request['azmoon']);
        return view('panel.admin.azmoonSoalbsoals.create', compact('azmoon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'pdf_file' => 'required',

            'tik_a' => 'required',
            'tik_b' => 'required',
            'tik_c' => 'required',
            'tik_d' => 'required',
            'key' => 'required',
        ]);

        $soalFileInputs = $request->except([
            'image',
            'pdf_file',
            'tik_a',
            'tik_b',
            'tik_c',
            'tik_d',
            'key',
        ]);
        $image = $request->file('image');
        $pdf = $request->file('pdf_file');
        if ($image) {
            $soalFileInputs['image'] = $this->UploadSoalFiles($image, 'soalat');
        }
        if ($pdf) {
            $soalFileInputs['pdf_file'] = $this->UploadSoalFiles($pdf, 'soalat');
        }
        $soalFile = AzmoonSoalatFile::create($soalFileInputs);

        $soalbsoalInputs = $request->except([
            'image',
            'pdf_file',
            'title',
        ]);
        $soalbsoalInputs['file_id'] = $soalFile->id;
        AzmoonSoalBSoal::create($soalbsoalInputs);

        return redirect(url()->previous())->with('success', 'با موفقیت ثبت گردید!');
    }

    public function UploadSoalFiles($file, $folder)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;

        $filename = Carbon::now()->timestamp . '.' . $file->getClientOriginalExtension();
        $dir = 'upload/' . $folder . '/' . $year . '/' . $month . '/' . $day . '/';
        $file->move(public_path($dir), $filename);
        return $dir . $filename;
    }

    public function destroy(AzmoonPorseshnameh $porseshnameh)
    {
        $porseshnameh->delete();
        return redirect(url()->previous())->with('success', 'با موفقیت حذف گردید!');
    }
}
