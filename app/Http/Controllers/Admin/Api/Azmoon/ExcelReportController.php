<?php

namespace App\Http\Controllers\Admin\Api\Azmoon;

use App\Azmoon;
use App\Exports\AzmoonReport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReportController extends Controller
{
    public function exportReport($azmoonId)
    {
        $azmoon = Azmoon::find($azmoonId);
        $filename = Carbon::now()->format('Ymdhms') . '-azmoon.xlsx';
        Excel::store(new AzmoonReport($azmoon), $filename);
        $file = Storage::get($filename);
        if ($file) {
            $fileLink = 'data:application/vnd.ms-excel;base64,' . base64_encode($file);
            @chmod(Storage::disk('local')->path($filename), 0755);
            @unlink(Storage::disk('local')->path($filename));
        }
        return response()->json([
            'data' => $fileLink,
            'filename' => $filename,
            'message' => 'Products are successfully exported.'
        ], 200);
    }
}
