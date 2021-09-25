<?php


namespace App\Traits;


use App\Azmoon;
use App\AzmoonPorseshnameh;
use App\AzmoonResult;
use Carbon\Carbon;

trait AzmoonTrait
{

    public function getAzmoonResultStudent($azmoonId,$studentId)
    {
        $azmoonResult = AzmoonResult::where('azmoon_id', $azmoonId)->where('user_id', $studentId)->first();
        $countOfTrueFalse=null;
        if ($azmoonResult){
            $this->checkAzmoonResultStatus($azmoonResult);

            if ($azmoonResult->status === 'incomplete'){
                return redirect(url()->previous())->with('warning','آزمون ناقص مانده است!');
            }

            if ($azmoonResult->result != null){

                $keysStr = AzmoonPorseshnameh::where('azmoon_id', $azmoonId)->first();
                $countOfTrueFalse = $this->countOfTrueFalseAnswers($azmoonResult,$keysStr);
                //$checkedResults= $this->countOfAzmoonChecked($azmoonResult->result,$keysStr->correct_key);

            }
        }
        return $countOfTrueFalse;
    }

    public function countOfAzmoonChecked($studentAnswersStr,$correctKeysStr): array
    {
        $resultExp = explode(',', $studentAnswersStr);
        $studentAnswers = $this->makeArrays($resultExp);

        $keyExp = explode(',', $correctKeysStr);
        $correctKeys = $this->makeArrays($keyExp);

        $export['correct'] = 0;
        $export['incorrect'] = 0;
        $export['empty'] = 0;
        foreach ($correctKeys as $key => $correctKey) {
            if (!array_key_exists($key, $studentAnswers)) {
                $export['empty']++;
            } else {
                if ($studentAnswers[$key] == $correctKey) {
                    $export['correct']++;
                } elseif ($studentAnswers[$key] != $correctKey) {
                    $export['incorrect']++;
                }
            }
        }

        return $export;
    }

    public function makeArrays(array $array)
    {
        $offerArray = array();
        foreach ($array as $item) {
            $arA = explode(':', $item);
            $offerArray[$arA[0]] = $arA[1];
        }
        return $offerArray;
    }

    public function checkAzmoonResultStatus($azmoonResult)
    {
        $azmoon = Azmoon::query()->where('id',$azmoonResult->azmoon_id)->first();
        if ($azmoonResult->status == 'testing'){
            $studentStartedTime = $azmoonResult->start_date;
            $azmoonTime = $azmoon->azmoon_time;
            $pastedTime = Carbon::now()->diffInMinutes($studentStartedTime);
            if ($pastedTime >= $azmoonTime){
                $azmoonResult->update([
                    'status'=>'incomplete'
                ]);
                //dd('expired ! ',$pastedTime);
            }else{

                //dd('you have time!');
            }
            //dd(Carbon::now()->diffInMinutes($studentStartedTime),$studentStartedTime,Carbon::now());


        }


        // check how many time pasted

    }

    public function azmoonResultExplode($azmoonResult)
    {
        $resultExp = explode(',', $azmoonResult);
        return $this->makeArrays($resultExp);
    }

    public function countOfTrueFalseAnswers($azmoon_result,$correct_keys)
    {
        $resCount['correct'] = 0;
        $resCount['incorrect'] = 0;
        $resCount['empty'] = 0;
        $result = $azmoon_result->result;
        if ($result != null) {

            $studentAnswers = $this->azmoonResultExplode($result);

            $correctKeys = $this->azmoonResultExplode( $correct_keys->correct_key);

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
        }
        return $resCount;
    }
}
