<?php


namespace App\Http\Controllers\Admin\Azmoon;


use App\Azmoon;
use App\Http\Controllers\Controller;

class AnalyticalReportController extends Controller
{
    public function agoReport(Azmoon $azmoon)
    {
        return view('panel.admin.azmoons.analyticalReports.ago',compact('azmoon'));
    }
}
