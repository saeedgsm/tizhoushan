<?php

namespace App\Http\Controllers\Student;

use App\Azmoon;
use App\AzmoonAdvancedResult;
use App\AzmoonAdvancePorseshnameh;
use App\AzmoonExclusive;
use App\AzmoonPayment;
use App\AzmoonPorseshnameh;
use App\AzmoonResult;
use App\EducationalBase;
use App\Http\Controllers\Controller;
use App\Traits\AzmoonResultTrait;
use App\Traits\AzmoonTrait;
use App\Traits\DefaultCoverTrait;
use App\Traits\OptionTrait;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AzmoonController extends Controller
{

    use AzmoonTrait, OptionTrait,DefaultCoverTrait;

    public function index()
    {
        $ss = auth()->user()->studentBaseClass()->first();

        $azmoons = [];
        if ($ss != null) {

            $allAzmoons = Azmoon::query()->select(['azmoon_title','azmoon_type','azmoon_start','id'])->where('azmoon_status', 1)->where('azmoon_for', 'exam')->latest()->get();

            $base = EducationalBase::where('id', $ss->base_id)->first();
            $loop = 0;
            foreach ($allAzmoons as $azmoon) {
                $azmoonBooks = $azmoon->azmoonBooks;

                if ($azmoon->class_type == 'elective') {
                   // dd($azmoon);
                    $azmoonClass=$azmoon->azmoonClasses->where('educational_class_id',$ss->class_id)->first();
                    if ($azmoonClass) {
                        $az_st = convertNumbers(Verta::instance($azmoon->azmoon_start)->format('H:i Y/m/d'));
                        $azmoon_cover = $this->checkDefaultImage($azmoon->soal->soal_cover,'azmoon_cover');
                        $azmoons[] = [
                            'id' => $azmoon->id,
                            'azmoon_title' => $azmoon->azmoon_title,
                            'azmoon_type' => $azmoon->azmoon_type,
                            'azmoon_start' => $az_st,
                            'soal_cover' => $azmoon_cover,
                        ];
                    }
                }else{
                    foreach ($azmoonBooks as $azmoonBook) {
                    $loop++;
                    $azmoonBook->book->id;
                    $check_book = $base->books()->where('id', $azmoonBook->book->id)->first();

                    if (empty($check_book) == false) {
                        $exclusive = AzmoonExclusive::query()->where('azmoon_id',$azmoon->id)->where('base_id',$base->id)->first();
                        $cc=false;
                        if ($exclusive){
                            if ($exclusive->classes != null || $exclusive->classes != ''){
                                $array_classes = explode(',',$exclusive->classes);
                                foreach ($array_classes as $array_class){
                                    $cc = $array_class == $ss->class_id;
                                    if ($cc == true){
                                        break;
                                    }
                                }
                            }
                        }else{
                            $cc=true;
                        }
                       // convertNumbers(Verta::instance($azmoon->azmoon_start)->format('H:i Y/m/d '))
                        $az_st = convertNumbers(Verta::instance($azmoonBook->azmoon->azmoon_start)->format('H:i Y/m/d'));
                        $azmoon_cover = $this->checkDefaultImage($azmoonBook->azmoon->soal->soal_cover,'azmoon_cover');
                        if ($cc == true){
                            $azmoons[] = [
                                'id' => $azmoonBook->azmoon->id,
                                'azmoon_title' => $azmoonBook->azmoon->azmoon_title,
                                'azmoon_type' => $azmoonBook->azmoon->azmoon_type,
                                'azmoon_start' => $az_st,
                                'soal_cover' => $azmoon_cover,
                            ];
                        }


                    }

                }
                }


            }

            $dd = collect($azmoons);
            $azmoons = $dd->unique();

        }
        
        return view('panel.student.azmoons.all', compact('azmoons'));
    }

    public function show(Azmoon $azmoon)
    {
        $soal = $azmoon->soal()->first();
        $files = $azmoon->soalatFiles()->latest()->get();
        $porseshnames = $azmoon->porseshnamehs()->get();
        $soalbsoals = $azmoon->soalbsoals()->get();
       //convertNumbers(Verta::instance($azmoon->azmoon_start)->format('H:i Y/m/d '))
        $azmoonDate['start'] = convertNumbers(Verta::instance($azmoon->azmoon_start)->format('H:i Y/m/d '));
        $azmoonDate['end'] = convertNumbers(Verta::instance($azmoon->azmoon_end)->format('H:i Y/m/d '));
        $checkAzmoon = AzmoonResult::where('user_id', auth()->user()->id)->where('azmoon_id', $azmoon->id)->first();

        $azmoonAble = true;
        if ($azmoon->type_payment == 'cash') {
            $azmoonPayment = \auth()->user()->azmoonPayments()->where('azmoon_id',$azmoon->id)->where('status',1)->first();
            if (! $azmoonPayment) {
                $azmoonAble = false;
            }
        }
        
        return view('panel.student.azmoons.show',
            compact('azmoon', 'soal', 'files', 'porseshnames', 'soalbsoals',
                'azmoonDate', 'checkAzmoon','azmoonAble'));
    }

    function convertNumbers($srting, $toPersian = true)
    {
        $en_num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $fa_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        if ($toPersian) return str_replace($en_num, $fa_num, $srting);
        else return str_replace($fa_num, $en_num, $srting);
    }

    public function start(Azmoon $azmoon)
    {
        if ($azmoon->azmoon_start >= Carbon::now()->format('Y-m-d H:i:s')) {
            return back()->with('error', 'به زمان آزمون مانده است!');
        }
        if ($azmoon->azmoon_end <= Carbon::now()->format('Y-m-d H:i:s')) {
            return back()->with('error', 'زمان آزمون به پایان رسیده است!');
        }

        $soal = $azmoon->soal()->first();

        $azmoonDate['start'] = $this->convertNumbers(new Verta($azmoon->azmoon_start));
        $azmoonDate['end'] = $this->convertNumbers(new Verta($azmoon->azmoon_end));

        if ($azmoon->azmoon_type == 'normal') {
            $checkAA = AzmoonResult::query()->where('azmoon_id', $azmoon->id)->where('user_id', auth()->user()->id)->first();
            if ($checkAA) {
               return redirect(route('student.azmoons.show',$azmoon));
                $azmoon_result = $checkAA;
            } else {
                $azmoon_result = new AzmoonResult();
            }

            $azmoon_result->user_id = auth()->user()->id;
            $azmoon_result->azmoon_id = $azmoon->id;
            $azmoon_result->status = "testing";
            $azmoon_result->start_date = Carbon::now();

            $files = $azmoon->soalatFiles()->latest()->get();
            if ($soal->type == 'porseshnameh') {
                $porseshnames = $azmoon->porseshnamehs()->get();
                $azmoonBook = $azmoon->azmoonBooks()->first();
                $book = $azmoonBook->book;

                $azmoon_result->save();

                return view('panel.student.azmoons.start', compact('azmoon', 'book',
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

    public function end(Request $request, Azmoon $azmoon)
    {
        $ck = AzmoonResult::where('azmoon_id', $azmoon->id)->where('user_id', auth()->user()->id)->first();
        if ($ck) {
            return redirect(route('student.azmoons.show', $azmoon))->with('warning', 'شما قبلا در این آزمون شرکت کرده اید!');
        }
        $res = new AzmoonResult();
        $res->user_id = auth()->user()->id;
        $res->azmoon_id = $azmoon->id;

        $answers = $request->except(['_token', '_method']);
        $lres = null;
        $array = array();
        foreach ($answers as $KEY => $i) {
            $array[] = $KEY . ':' . $i;
        }
        $lres = implode(",", $array);
        $res->result = $lres;
        $res->end_date = Carbon::now();
        $res->save();
        /* $keysStr = AzmoonPorseshnameh::where('azmoon_id', $azmoon->id)->first();
         $countChecked = $this->countOfAzmoonChecked($lres,$keysStr->correct_key);

         $res->update([
             'correct_count'=>$countChecked["correct"],
             'wrong_count' => $countChecked["incorrect"],
             'not_answer_count' => $countChecked["empty"],
         ]);*/

        return response($res);
        //  return redirect(route('student.azmoons.result',$azmoon))->with('success','آزمون را با موفقیت پایان رساندید!');
    }

    public function result(Azmoon $azmoon)
    {
        $resultStr = AzmoonResult::where('azmoon_id', $azmoon->id)->where('user_id', auth()->user()->id)->first();
        $resultExp = explode(',', $resultStr->result);
        //dd(($resultExp[0] == ""));


        $keysStr = AzmoonPorseshnameh::where('azmoon_id', $azmoon->id)->first();
        if ($keysStr) {
            $keyExp = explode(',', $keysStr->correct_key);
            $correctKeys = $this->makeArrays($keyExp);
        } else {
            return back()->with('warning', 'نتایج قابل محاسبه نیست! لطفا بعدا بررسی کنید!');
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
            $emptyCk = $azmoon->soal->soal_count;
        }

        $check = $resultStr->update([
            'correct_count' => $trueCk,
            'wrong_count' => $falseCk,
            'not_answer_count' => $emptyCk
        ]);
        if ($check != 1) {
            echo 'err';
        }
        $soal = $azmoon->soal()->first();

        return view('panel.student.azmoons.result', compact('azmoon', 'emptyCk', 'trueCk', 'falseCk', 'soal', 'studentAnswers', 'correctKeys'));
    }

    public function karnameh(Azmoon $azmoon)
    {
        $user = auth()->user();
        $regClassStudent = $user->studentBaseClass;
        $soal = $azmoon->soal()->first();
        //Verta::instance($azmoon->azmoon_start)->format('H:i Y/m/d ');
        $azmoonDate['start'] = convertNumbers(Verta::instance($azmoon->azmoon_start)->format(' Y/m/d '));
        $azmoonDate['end'] = convertNumbers(Verta::instance($azmoon->azmoon_end)->format(' Y/m/d '));

      //  $resCount = $this->getAzmoonResultStudent($azmoon->id, auth()->user()->id);
       // dd($resCount );
        $resultStr = AzmoonResult::where('azmoon_id', $azmoon->id)->where('user_id', auth()->user()->id)->first();

        if (!$resultStr) {
            //dd(22);
            return redirect(route('student.azmoons.all'));
        }
        $studentAnswers = [];
        if ($resultStr->result != null) {
            $resultExp = explode(',', $resultStr->result);
            $studentAnswers = $this->makeArrays($resultExp);
        }


        $keysStr = AzmoonPorseshnameh::where('azmoon_id', $azmoon->id)->first();
        $keyExp = explode(',', $keysStr->correct_key);
        $correctKeys = $this->makeArrays($keyExp);

        $resCount['correct'] = 0;
        $resCount['incorrect'] = 0;
        $resCount['empty'] = 0;
        if ($studentAnswers) {
            foreach ($correctKeys as $key => $correctKey) {
                if (!array_key_exists($key, $studentAnswers)) {
                    $resCount['empty']++;
                } else {
                    if ($studentAnswers[$key] == $correctKey) {
                        $resCount['correct']++;
                    } elseif ($studentAnswers[$key] != $correctKey) {
                        $resCount['incorrect']++;
                    }
                }
            }
        }else{
            $resCount['empty']=$soal->soal_count;
        }

        $resultStr->update([
            'correct_count' => $resCount['correct'],
            'wrong_count' => $resCount['incorrect'],
            'not_answer_count' => $resCount['empty'],
        ]);

        return view('panel.student.azmoons.karnameh', compact('azmoon', 'user', 'regClassStudent', 'azmoonDate', 'resCount', 'soal', 'studentAnswers', 'correctKeys'));
    }

    public function karnamehAdvanced(Azmoon $azmoon)
    {
       // return $azmoon;
        $user = auth()->user();
        $regClassStudent = $user->studentBaseClass;
        $soal = $azmoon->soal()->first();
        $azmoonDate['start'] = $this->convertNumbers(new Verta($azmoon->azmoon_start));
        $azmoonDate['end'] = $this->convertNumbers(new Verta($azmoon->azmoon_end));

        $azmoon_results = AzmoonAdvancedResult::query()
            ->where('azmoon_id',$azmoon->id)
            ->where('user_id',\auth()->user()->id)
            ->get();

        foreach ($azmoon_results as $azmoon_result){
            $correct_keys = AzmoonAdvancePorseshnameh::query()
                ->where('azmoon_id',$azmoon->id)
                ->where('book_id',$azmoon_result->book_id)
                ->first();

            $finalResult = $this->countOfTrueFalseAnswers($azmoon_result,$correct_keys);

           $last_data[] = [
               'book_id' => $azmoon_result->book_id,
               'book_name' => $correct_keys->book->book_name,
               'correct' => $finalResult['correct'],
               'incorrect' => $finalResult['incorrect'],
               'empty' => $finalResult['empty'],
               'book_nomreh' => $correct_keys->book->nomreh,
               'Percentage' => '0',
               'max' => '0',
               'min' => '0',
           ];
          // dd($last_data);
        }

     //   $resCount = $this->getAzmoonResultStudent($azmoon->id, auth()->user()->id);
      //  $resultStr = AzmoonResult::where('azmoon_id', $azmoon->id)->where('user_id', auth()->user()->id)->first();
        return view('panel.student.azmoons.karnameh_advanced', compact('azmoon', 'user', 'regClassStudent', 'azmoonDate', 'soal','last_data'));
    }

    public function endAzmoon(Request $request)
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
        $msg['msg'] = 'آزمون را با موفقیت به پایان رساندید!';
        return response($msg);
    }

    public function endAzmoonAdvanced(Request $request)
    {
        $azmoon = Azmoon::where('id', $request['azmoon_id'])->first();
        $azmoon_results = AzmoonAdvancedResult::query()
            ->where('azmoon_id', $azmoon->id)
            ->where('user_id', auth()->user()->id)
            ->get();
        $answers = $request->except(['azmoon_id']);
        $key_val=null;
        foreach ($answers as $KEY => $value) {
            $key_names = explode('_', $KEY);
            $key_val[$key_names[0]]['book_id'] = $key_names[0];
            $key_val[$key_names[0]]['result'][] = $key_names[1] . ':' . $value;
        }

        foreach ($key_val as $value){
            $result = implode(",", $value['result']);
            $azmoon_result = $azmoon_results->where('book_id',$value['book_id'])->first();
            $azmoon_result->update([
                'result'=>$result,
                'status'=>'completed',
                'end_date'=>Carbon::now()
            ]);
        }
        $msg['type'] = 'success';
        $msg['msg'] = 'آزمون را با موفقیت به پایان رساندید!';
        return response($msg);
    }

    public function exportPDF(Azmoon $azmoon)
    {

        /*$user = auth()->user();
        $regClassStudent = $user->studentBaseClass;
        $soal = $azmoon->soal()->first();
        $azmoonDate['start'] = $this->convertNumbers(new Verta($azmoon->azmoon_start));
        $azmoonDate['end'] = $this->convertNumbers(new Verta($azmoon->azmoon_end));


        $resultStr = AzmoonResult::where('azmoon_id', $azmoon->id)->where('user_id', auth()->user()->id)->first();
        $resultExp = explode(',', $resultStr->result);
        $studentAnswers = $this->makeArrays($resultExp);

        $keysStr = AzmoonPorseshnameh::where('azmoon_id', $azmoon->id)->first();
        $keyExp = explode(',', $keysStr->correct_key);
        $correctKeys = $this->makeArrays($keyExp);

        $resCount['correct'] = 0;
        $resCount['incorrect'] = 0;
        $resCount['empty'] = 0;
        foreach ($correctKeys as $key => $correctKey) {
            if (!array_key_exists($key, $studentAnswers)) {
                $resCount['empty']++;
            } else {
                if ($studentAnswers[$key] == $correctKey) {
                    $resCount['correct']++;
                } elseif ($studentAnswers[$key] != $correctKey) {
                    $resCount['incorrect']++;
                }
            }
        }

        view()->share(['azmoon' => $azmoon, 'user' => $user, 'regClassStudent' => $regClassStudent, 'azmoonDate' => $azmoonDate, 'resCount' => $resCount, 'soal' => $soal]);
        $pdf_doc = PDF::loadView('panel.student.azmoons.karnameh', [$azmoon, $user, $regClassStudent, $azmoonDate, $resCount, $soal]);

        return $pdf_doc->download('pdf.pdf');*/
    }

    public function updateResult(Request $request)
    {
        $azmoonResult = AzmoonResult::query()
            ->where('user_id', $request['user_id'])
            ->where('azmoon_id', $request['azmoon_id'])
            ->first();
        $checkboxName = $request['name'];
        $checkboxValue = $request['value'];
        $checkboxStatus = $request['status'];
        if ($azmoonResult->result == null) {
            $result = $checkboxName . ':' . $checkboxValue;
            $azmoonResult->update(['result' => $result]);
        } else {
            $studentAnswers = $this->azmoonResultExplode($azmoonResult->result);
            if (array_key_exists($checkboxName, $studentAnswers)) {
                if ($checkboxStatus == 'true') {
                    $checkValue = $studentAnswers[$checkboxName] == $checkboxValue;
                    if ($checkValue == false) {
                        // false

                        $newVal = [$checkboxName => $checkboxValue];
                        $studentAnswers = array_replace($studentAnswers, $newVal);

                        $result = null;
                        $array = array();
                        foreach ($studentAnswers as $KEY => $i) {
                            $array[] = $KEY . ':' . $i;
                        }
                        $result = implode(",", $array);
                        $azmoonResult->update(['result' => $result]);
                        //return 'changed';
                    } else {
                        // if == true
                        // no need work
                    }
                } else {
                    // false
                    unset($studentAnswers[$checkboxName]);
                    $result = null;
                    $array = array();
                    foreach ($studentAnswers as $KEY => $i) {
                        $array[] = $KEY . ':' . $i;
                    }
                    $result = implode(",", $array);
                    $azmoonResult->update(['result' => $result]);
                    return $studentAnswers;
                }
// ok
            } else {
                if ($checkboxStatus == 'true') {
                    //return 'true';
                    // $newVal = ["$checkboxName"=>"$checkboxValue"];
                    $studentAnswers[$checkboxName] = $checkboxValue;
                    ksort($studentAnswers);
                    //$studentAnswers = array_push($studentAnswers,["$checkboxName"=>"$checkboxValue"]);
                    $result = null;
                    $array = array();
                    foreach ($studentAnswers as $KEY => $i) {
                        $array[] = $KEY . ':' . $i;
                    }
                    $result = implode(",", $array);
                    $azmoonResult->update(['result' => $result]);
                    return $studentAnswers;
                } else {
                    // false
                    unset($studentAnswers[$checkboxName]);
                    $result = null;
                    $array = array();
                    foreach ($studentAnswers as $KEY => $i) {
                        $array[] = $KEY . ':' . $i;
                    }
                    $result = implode(",", $array);
                    $azmoonResult->update(['result' => $result]);
                    return $studentAnswers;

                }
            }
            return 'end line';
        }
        return $request->all();
    }

    public function updateAdvancedResult(Request $request)
    {
        // return $request->all();
        $req_names = explode('_', $request['name']);
        $reqs['book_id'] = $req_names[0];
        $reqs['name'] = $req_names[1];
        $reqs['value'] = $request['value'];
        $reqs['status'] = $request['status'];

        $azmoonResult = AzmoonAdvancedResult::query()
            ->where('user_id', $request['user_id'])
            ->where('azmoon_id', $request['azmoon_id'])
            ->where('book_id', $reqs['book_id'])
            ->first();
        /*$checkboxName = $request['name'];
        $checkboxValue = $request['value'];
        $checkboxStatus = $request['status'];*/
        if ($azmoonResult->result == null) {
            $result = $reqs['name'] . ':' . $reqs['value'];
            $azmoonResult->update(['result' => $result]);
            return 'end first if';

        } else {
            $studentAnswers = $this->azmoonResultExplode($azmoonResult->result);
            if (array_key_exists($reqs['name'], $studentAnswers)) {
                if ($reqs['status'] == 'true') {
                    $checkValue = $studentAnswers[$reqs['name']] == $reqs['value'];
                    if ($checkValue == false) {

                        $newVal = [$reqs['name'] => $reqs['value']];
                        $studentAnswers = array_replace($studentAnswers, $newVal);

                        $result = null;
                        $array = array();
                        foreach ($studentAnswers as $KEY => $i) {
                            $array[] = $KEY . ':' . $i;
                        }
                        $result = implode(",", $array);
                        $azmoonResult->update(['result' => $result]);
                    } else {
                        // if == true
                        // no need work
                    }
                } else {
                    // false
                    unset($studentAnswers[$reqs['name']]);
                    $result = null;
                    $array = array();
                    foreach ($studentAnswers as $KEY => $i) {
                        $array[] = $KEY . ':' . $i;
                    }
                    $result = implode(",", $array);
                    $azmoonResult->update(['result' => $result]);
                    return $studentAnswers;
                }
            } else {
                if ($reqs['status'] == 'true') {
                    $studentAnswers[$reqs['name']] = $reqs['value'];
                    ksort($studentAnswers);
                    $result = null;
                    $array = array();
                    foreach ($studentAnswers as $KEY => $i) {
                        $array[] = $KEY . ':' . $i;
                    }
                    $result = implode(",", $array);
                    $azmoonResult->update(['result' => $result]);
                    return $studentAnswers;
                } else {
                    // false
                    unset($studentAnswers[$reqs['name']]);
                    $result = null;
                    $array = array();
                    foreach ($studentAnswers as $KEY => $i) {
                        $array[] = $KEY . ':' . $i;
                    }
                    $result = implode(",", $array);
                    $azmoonResult->update(['result' => $result]);
                    return $studentAnswers;

                }
            }
            return 'end else';
        }


        // return $request->all();
    }


}
