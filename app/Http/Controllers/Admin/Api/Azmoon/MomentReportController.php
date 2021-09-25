<?php

namespace App\Http\Controllers\Admin\Api\Azmoon;

use App\Azmoon;
use App\AzmoonPorseshnameh;
use App\AzmoonResult;
use App\AzmoonSoalat;
use App\Http\Controllers\Controller;
use App\RegisterClassStudent;
use App\Traits\AzmoonTrait;
use App\Traits\OptionTrait;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;

class MomentReportController extends Controller
{

    use OptionTrait, AzmoonTrait;
    public function report($azmoonId)
    {
        $azmoon = Azmoon::query()->where('id', $azmoonId)->first();
        $azmoonInStudents = AzmoonResult::query()->where('azmoon_id', $azmoon->id)->get();
        $results = [];
        if ($azmoon->class_type == 'elective') {
            $azmoonClasses = $azmoon->azmoonClasses;
            foreach ($azmoonClasses as $item) {
                $registers = RegisterClassStudent::query()->where('class_id', $item->educational_class_id)->get();
                if ($registers->isNotEmpty()) {
                    foreach ($registers as $st) {
                        $student = User::query()->where('id', $st->user_id)->first();
                        $check = $azmoonInStudents->where('user_id', $st->user_id)->first();
                        $st_report['actions'] = $student->id;
                        $st_report['usercode'] = $student->usercode;
                        $st_report['fullname'] = $student->last_name . " " . $student->first_name;
                        $st_report['base_id'] = $st->base_id;
                        $st_report['base_title'] = $st->educationBase->base_title;
                        if ($st->class_id == null) {
                            $st_report['class_id'] = "نا مشخص";
                            $st_report['class_title'] = "نا مشخص";
                        } else {
                            $st_report['class_id'] = $st->class_id;
                            $st_report['class_title'] = $st->educationClass->class_title;
                        }
                        if ($check == null) {
                            $st_report['azmoon_status'] = "غائب";
                            $st_report['azmoon_start'] = "غائب";
                            $st_report['percent'] = 0;
                            $st_report['correct'] = 0;
                            $st_report['incorrect'] = 0;
                            $st_report['not_answer'] = 0;
                            // array_push($results, $allStudent);

                        }
                        if ($check != null) {
                            if ($check->status == 'testing') {
                                $now = Carbon::parse($check->start_date)->diffInMinutes();
                                if ($azmoon->azmoon_time < $now) {
                                    //var_dump($check->status);
                                    $check->update(['status' => 'completed']);
                                    // var_dump($check->status);
                                }
                            }
                            $ss = $check->status == 'testing' ? 'در حال آزمون' : 'تموم شده';
                            $st_report['azmoon_status'] = $ss;

                            $st_report['azmoon_start'] = convertNumbers(Verta::instance($check->start_date)->format('H:i Y/m/d '));
                            $st_report['percent'] = round($check->correct_count / $azmoon->soal->soal_count * 100);
                            $st_report['correct'] = $check->correct_count;
                            $st_report['incorrect'] = $check->wrong_count;
                            $st_report['not_answer'] = $check->not_answer_count;
                            $st_report['result'] = $check->result;
                            //return $st_report;
                        }
                        array_push($results, $st_report);
                    }
                }
            }
        } else {
            $azmoonBooks = $azmoon->azmoonBooks()->get();
            foreach ($azmoonBooks as $book) {
                $bases = $book->book->bases;
                foreach ($bases as $base) {
                    $registers = RegisterClassStudent::query()->where('base_id', $base->id)->get();
                    if ($registers->isNotEmpty()) {
                        foreach ($registers as $st) {
                            $student = User::query()->where('id', $st->user_id)->first();
                            $check = $azmoonInStudents->where('user_id', $st->user_id)->first();
                            $st_report['actions'] = $student->id;
                            $st_report['usercode'] = $student->usercode;
                            $st_report['fullname'] = $student->last_name . " " . $student->first_name;
                            $st_report['base_id'] = $st->base_id;
                            $st_report['base_title'] = $st->educationBase->base_title;
                            if ($st->class_id == null) {
                                $st_report['class_id'] = "نا مشخص";
                                $st_report['class_title'] = "نا مشخص";
                            } else {
                                $st_report['class_id'] = $st->class_id;
                                $st_report['class_title'] = $st->educationClass->class_title;
                            }
                            if ($check == null) {
                                $st_report['azmoon_status'] = "غائب";
                                $st_report['azmoon_start'] = "غائب";
                                $st_report['percent'] = 0;
                                $st_report['correct'] = 0;
                                $st_report['incorrect'] = 0;
                                $st_report['not_answer'] = 0;
                            }
                            if ($check != null) {
                                if ($check->status == 'testing') {
                                    $now = Carbon::parse($check->start_date)->diffInMinutes();
                                    if ($azmoon->azmoon_time < $now) {
                                        $check->update(['status' => 'completed']);
                                    }
                                }
                                $ss = $check->status == 'testing' ? 'در حال آزمون' : 'تموم شده';
                                $st_report['azmoon_status'] = $ss;
                                $st_report['azmoon_start'] = convertNumbers(Verta::instance($check->start_date)->format('H:i Y/m/d '));
                                $st_report['percent'] = round($check->correct_count / $azmoon->soal->soal_count * 100);
                                $st_report['correct'] = $check->correct_count;
                                $st_report['incorrect'] = $check->wrong_count;
                                $st_report['not_answer'] = $check->not_answer_count;
                                $st_report['result'] = $check->result;
                            }
                            array_push($results, $st_report);
                        }
                    }
                }
            }
        }
        //$countStudents = count($results);
        // $results = $this->paginate($results);
        // $results->withPath(url()->current());
        $soal = $azmoon->soal;
        return response(['results' => $results, 'azmoon' => $azmoon, 'soal' => $soal]);
    }

    public function processStudents($registers,$azmoonInStudents,$azmoon)
    {
        if ($registers->isNotEmpty()) {
            foreach ($registers as $st) {
                $student = User::query()->where('id', $st->user_id)->first();
                $check = $azmoonInStudents->where('user_id', $st->user_id)->first();
                $st_report['actions'] = $student->id;
                $st_report['usercode'] = $student->usercode;
                $st_report['fullname'] = $student->last_name . " " . $student->first_name;
                $st_report['base_id'] = $st->base_id;
                $st_report['base_title'] = $st->educationBase->base_title;
                if ($st->class_id == null) {
                    $st_report['class_id'] = "نا مشخص";
                    $st_report['class_title'] = "نا مشخص";
                } else {
                    $st_report['class_id'] = $st->class_id;
                    $st_report['class_title'] = $st->educationClass->class_title;
                }
                if ($check == null) {
                    $st_report['azmoon_status'] = "غائب";
                    $st_report['azmoon_start'] = "غائب";
                    $st_report['percent'] = 0;
                    $st_report['correct'] = 0;
                    $st_report['incorrect'] = 0;
                    $st_report['not_answer'] = 0;
                }
                if ($check != null) {
                    if ($check->status == 'testing') {
                        $now = Carbon::parse($check->start_date)->diffInMinutes();
                        if ($azmoon->azmoon_time < $now) {
                            $check->update(['status' => 'completed']);
                        }
                    }
                    $ss = $check->status == 'testing' ? 'در حال آزمون' : 'تموم شده';
                    $st_report['azmoon_status'] = $ss;
                    $st_report['azmoon_start'] = convertNumbers(Verta::instance($check->start_date)->format('H:i Y/m/d '));
                    $st_report['percent'] = $check->correct_count / $azmoon->soal->soal_count * 100;
                    $st_report['correct'] = $check->correct_count;
                    $st_report['incorrect'] = $check->wrong_count;
                    $st_report['not_answer'] = $check->not_answer_count;
                    $st_report['result'] = $check->result;
                }
                array_push($results, $st_report);
            }
        }
    }

    public function studentResetResult(Request $request)
    {
        try {
            $result = AzmoonResult::query()
                ->where('azmoon_id', $request['azmoon_id'])
                ->where('user_id', $request['user_id'])->first();
            if ($result) {
                $result->delete();
                return response(['icon' => 'success', 'title' => 'عملیات موفقیت آمیز', 'text' => 'نتایج آزمون دانش آموز با موفقیت ریست شد!']);
            } else {
                return response(['icon' => 'info', 'title' => 'اطلاعیه', 'text' => 'نتایج دانش آموز خالی بود!']);
            }
        } catch (\Throwable $th) {
            return response(['icon' => 'error', 'title' => 'خطا', 'text' => 'عملیات با مشکل روبرو شد!', 'error' => $th->getMessage()]);
        }
    }

    public function studentUpdateResult(Request $request)
    {

        $result = AzmoonResult::query()
            ->where('azmoon_id', $request['azmoon_id'])
            ->where('user_id', $request['user_id'])->first();

        $correctKey = AzmoonPorseshnameh::query()->where('azmoon_id', $request['azmoon_id'])->first();
        $export['correct'] = 0;
        $export['incorrect'] = 0;
        $export['empty'] = 0;
        if ($correctKey) {
            $export = $this->countOfAzmoonChecked($request['result'], $correctKey->correct_key);
        }
        if ($result) {
            $result->update([
                'result' => $request['result'],
                'status' => 'completed',
                'correct_count' => $export['correct'],
                'wrong_count' => $export['incorrect'],
                'not_answer_count' => $export['empty'],
                'start_date'=>Carbon::now()
            ]);
            $icon='success';
            $title='عملیات موفقیت آمیز';
            $text='نتایج دانش آموز با موفقیت ویرایش گردید!';
        } else {
            $result = AzmoonResult::create([
                'azmoon_id' => $request['azmoon_id'],
                'user_id' => $request['user_id'],
                'result' => $request['result'],
                'status' => 'completed',
                'correct_count' => $export['correct'],
                'wrong_count' => $export['incorrect'],
                'not_answer_count' => $export['empty'],
                'start_date'=>Carbon::now()
            ]);
            $icon='success';
            $title='عملیات موفقیت آمیز';
            $text='نتایج دانش آموز با موفقیت ثبت گردید!';
        }
        $soalCount = $result->azmoon->soal->soal_count;
        $result['percent'] = round($export['correct'] / $soalCount * 100);
        $result['azmoon_start']=convertNumbers(Verta::instance($result->start_date)->format('H:i Y/m/d '));
        return response(['result' => $result, 'icon' => $icon, 'title' => $title, 'text' => $text]);
    }
}
