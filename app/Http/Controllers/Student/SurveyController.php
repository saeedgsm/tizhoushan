<?php


namespace App\Http\Controllers\Student;


use App\Azmoon;
use App\AzmoonAdvancedResult;
use App\AzmoonPorseshnameh;
use App\AzmoonResult;
use App\Http\Controllers\Controller;
use App\Traits\AzmoonTrait;
use App\Traits\DefaultCoverTrait;
use App\Traits\OptionTrait;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    use OptionTrait,DefaultCoverTrait,AzmoonTrait;
    public function index()
    {
        $surveys = Azmoon::query()->with(['soal'])
            ->select(['azmoon_title','azmoon_type','azmoon_start','id'])
            ->where('azmoon_status', 1)
            ->where('azmoon_for', 'survey')
            ->latest()->get();
        return view('panel.student.surveys.all',compact('surveys'));
    }

    public function show(Azmoon $survey)
    {
        $soal = $survey->soal()->first();
        $files = $survey->soalatFiles()->latest()->get();
        $porseshnames = $survey->porseshnamehs()->get();
        $soalbsoals = $survey->soalbsoals()->get();
        //convertNumbers(Verta::instance($azmoon->azmoon_start)->format('H:i Y/m/d '))
        $azmoonDate['start'] = convertNumbers(Verta::instance($survey->azmoon_start)->format('H:i Y/m/d '));
        $azmoonDate['end'] = convertNumbers(Verta::instance($survey->azmoon_end)->format('H:i Y/m/d '));
        $checkAzmoon = AzmoonResult::where('user_id', auth()->user()->id)->where('azmoon_id', $survey->id)->first();
        return view('panel.student.surveys.show', compact('survey', 'soal', 'files', 'porseshnames', 'soalbsoals', 'azmoonDate', 'checkAzmoon'));
    }

    public function start(Azmoon $survey)
    {
        if ($survey->azmoon_start >= Carbon::now()->format('Y-m-d H:i:s')) {
            return back()->with('error', 'به زمان آزمون مانده است!');
        }
        if ($survey->azmoon_end <= Carbon::now()->format('Y-m-d H:i:s')) {
            return back()->with('error', 'زمان آزمون به پایان رسیده است!');
        }

        $soal = $survey->soal()->first();

        $azmoonDate['start'] = $this->convertNumbers(new Verta($survey->azmoon_start));
        $azmoonDate['end'] = $this->convertNumbers(new Verta($survey->azmoon_end));

        if ($survey->azmoon_type == 'normal') {
            $checkAA = AzmoonResult::query()->where('azmoon_id', $survey->id)->where('user_id', auth()->user()->id)->first();
            if ($checkAA) {
                //return redirect(route('student.azmoons.show',$survey));
                $azmoon_result = $checkAA;
            } else {
                $azmoon_result = new AzmoonResult();
            }

            $azmoon_result->user_id = auth()->user()->id;
            $azmoon_result->azmoon_id = $survey->id;
            $azmoon_result->status = "testing";
            $azmoon_result->start_date = Carbon::now();

            $files = $survey->soalatFiles()->latest()->get();
            if ($soal->type == 'porseshnameh') {
                $porseshnames = $survey->porseshnamehs()->get();
                $azmoonBook = $survey->azmoonBooks()->first();
                $book = $azmoonBook->book;

                $azmoon_result->save();

                return view('panel.student.surveys.start', compact('survey', 'book',
                    'soal', 'files', 'porseshnames', 'azmoonDate', 'azmoon_result'));


            } else {
                // soal type == soal_b_soal

            }

            //$soal = $azmoon->soal()->first();
            // $files = $azmoon->soalatFiles()->latest()->get();
            //$porseshnames = $azmoon->porseshnamehs()->get();
            //  $soalbsoals = $azmoon->soalbsoals()->get();
            // $azmoonDate['start'] = $this->convertNumbers(new Verta($azmoon->azmoon_start));
            // $azmoonDate['end'] = $this->convertNumbers(new Verta($azmoon->azmoon_end));

            $azmoon_result->save();
            return view('panel.student.azmoons.start', compact('azmoon', 'soal', 'files', 'porseshnames', 'soalbsoals', 'azmoonDate', 'azmoon_result'));
        } elseif ($azmoon->azmoon_type == 'advanced') {
            $advancedResults = AzmoonAdvancedResult::query()->where('azmoon_id', $azmoon->id)->where('user_id', auth()->user()->id)->get();
            $books = $azmoon->azmoonBooks;
            $files = $azmoon->advancedFiles()->orderBy('book_id', 'asc')->latest()->get();
            if ($advancedResults->isEmpty()) {
                foreach ($books as $book) {
                    AzmoonAdvancedResult::create([
                        'user_id' => auth()->user()->id,
                        'azmoon_id' => $azmoon->id,
                        'book_id' => $book->book_id,
                        'start_date' => Carbon::now(),
                        'status' => 'testing',
                    ]);
                }
                $advancedResults = AzmoonAdvancedResult::query()->where('azmoon_id', $azmoon->id)->where('user_id', auth()->user()->id)->get();
            }
            if ($soal->type == 'porseshnameh') {
                $advancedPorseshnamehs = $azmoon->advancedPorseshnamehs()->orderBy('book_id', 'asc')->get();
                return view('panel.student.azmoons.testing.advanced.porseshnameh', compact('azmoon', 'books',
                    'soal', 'files', 'advancedPorseshnamehs', 'azmoonDate', 'advancedResults'));


            } else {
                // soal type == soal_b_soal

            }


            return 'advanced';
        }

        return back()->with('warning', 'در اجرا آزمون مشکلی پیش آمده است لطفا با مدیریت تماس بگیرید!');

    }

    public function endSurvey(Request $request)
    {
        $azmoon = Azmoon::where('id', $request['azmoon_id'])->first();
        $azmoon_result = AzmoonResult::where('azmoon_id', $azmoon->id)->where('user_id', auth()->user()->id)->first();
        $answers = $request->except(['azmoon_id']);
        $lres = null;
        $array = array();
        foreach ($answers as $KEY => $i) {
            $array[] = $KEY . ':' . $i;
        }
        $lres = implode(",", $array);
        $azmoon_result->result = $lres;
        $azmoon_result->end_date = Carbon::now();
        $azmoon_result->status = "completed";
        $azmoon_result->save();

        $msg['type'] = 'success';
        $msg['msg'] = 'نظرسنجی را با موفقیت به پایان رساندید!';
        return response($msg);
    }

    public function result(Azmoon $survey)
    {
        $resultStr = AzmoonResult::where('azmoon_id', $survey->id)->where('user_id', auth()->user()->id)->first();
        $resultExp = explode(',', $resultStr->result);
        //dd(($resultExp[0] == ""));


        $keysStr = AzmoonPorseshnameh::where('azmoon_id', $survey->id)->first();
        if ($keysStr) {
            $keyExp = explode(',', $keysStr->correct_key);
            $correctKeys = $this->makeArrays($keyExp);
        } else {
            return redirect(route('student.surveys.all'))->with('warning', 'نتایج قابل محاسبه نیست! لطفا بعدا بررسی کنید!');
        }

        $trueCk = 0;
        $falseCk = 0;
        $emptyCk = 0;
        if ($resultExp[0] != "") {
            $studentAnswers = $this->makeArrays($resultExp);
            foreach ($correctKeys as $key => $correctKey) {
                if (!array_key_exists($key, $studentAnswers)) {
                    $emptyCk++;
                } else {
                    if ($studentAnswers[$key] == $correctKey) {
                        $trueCk++;
                    } elseif ($studentAnswers[$key] != $correctKey) {
                        $falseCk++;
                    }
                }
            }
        } else {
            $studentAnswers = [];
            $emptyCk = $survey->soal->soal_count;
        }

        $check = $resultStr->update([
            'correct_count' => $trueCk,
            'wrong_count' => $falseCk,
            'not_answer_count' => $emptyCk
        ]);
        if ($check != 1) {
            echo 'err';
        }
        $soal = $survey->soal()->first();

        return view('panel.student.surveys.result', compact('survey', 'emptyCk', 'trueCk', 'falseCk', 'soal', 'studentAnswers', 'correctKeys'));
    }
}