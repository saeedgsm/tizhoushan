<?php

namespace App\Http\Controllers\Admin\Api\Dashboard;

use App\Azmoon;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboardInfo()
    {

       // $az = Azmoon::query()->where('azmoon_status','1')->latest();
       $activeAzmoonCount = Azmoon::query()->where('azmoon_status','1')->count();
        $azmoons = Azmoon::query()->where('azmoon_status','1')->latest()->take(3)->get();
        $activeAzmoons=[];
        foreach ($azmoons as $value) {
            $az = [
                'id'=>$value->id,
                'azmoon_title'=>$value->azmoon_title,
                //'azmoon_link'=>asset("azmoon/start/" . $value->azmoon_code),
                'start_date'=>convertNumbers(Verta::instance($value->start_date)->format('H:i Y/m/d ')),
            ];
            array_push($activeAzmoons,$az);
        }

        $subMonth = Carbon::now()->subMonth();
        $students = User::query()->where('level','student')->get();
        $studentCount = $students->count();
        $registerLastMonth = $students->where('created_at', '>', $subMonth)->count();
        return response([
            'student_count'=>$studentCount,
            'register_last_month'=>$registerLastMonth,
            'azmoon_count'=>$activeAzmoonCount,
            'azmoons'=>$activeAzmoons
        ]);
    }
}
