<?php


namespace App\Http\Controllers\Admin\Api\Azmoon;


use App\Azmoon;
use App\AzmoonAdvancedResult;
use App\Book;
use App\Http\Controllers\Controller;
use App\Traits\AzmoonTrait;

class AnalyticalReportController extends Controller
{
    use AzmoonTrait;

    public function analyticalReport($azmoonId)
    {
        $azmoon = Azmoon::find($azmoonId);
        $booksId= $azmoon->azmoonBooks;
        $studentCount=0;
        foreach ($booksId as $item) {
            $book=Book::find($item->book_id);
            $bases=$book->bases;
            foreach ($bases as $basis){
                $classes= $basis->educationClasses;
                foreach ($classes as $class) {
                    $studentCount+=count($class->classStudents);
                    //return count($class->classStudents);
                }
            }
        }
       // dd($studentCount);

        $lastData=[];
        if ($azmoon->azmoon_type == 'normal') {
            $last=[];
            $porseshnames = $azmoon->porseshnamehs->first();
            $book = Book::query()->where('id',$booksId[0]['book_id'])->first();

            $correctKeys = null;
            if ($porseshnames) {
                $keyExp = explode(',', $porseshnames->correct_key);
                $correctKeys = $this->makeArrays($keyExp);
            }
            $azmoonResults = $azmoon->AzmoonPorseshnamehResults()->get();
            $testedCount = 0;$testedNotAnswerCount = 0;$testedAnswerCount = 0;
            $resultCount=count($azmoonResults);$correctKeysCount=count($correctKeys);
            foreach ($azmoonResults as $azmoonResult) {
                $testedCount++;
                $resultExp = explode(',', $azmoonResult->result);
                $trueCk = 0;
                $falseCk = 0;
                $emptyCk = 0;
                if ($resultExp[0] != "") {
                    $testedAnswerCount++;
                    $studentAnswers = $this->makeArrays($resultExp);
                    $checkedCount=0;
                    foreach ($correctKeys as $key => $correctKey) {
                        $soalDetails = [
                            'soalNumber' => 0,
                            'soalKey' => 0,
                            'uncheckedCount' => 0,
                            'correctCount' => 0,
                            'incorrectCount' => 0,
                            'optionACount' => 0,
                            'optionBCount' => 0,
                            'optionCCount' => 0,
                            'optionDCount' => 0,
                            'percent' => 0
                        ];
                        $checkedCount++;
                        if ($testedCount==1){
                            $soalDetails['soalNumber']=$key;
                            $soalDetails['soalKey']=$correctKey;

                            if (!array_key_exists($key, $studentAnswers)) {
                                $soalDetails['uncheckedCount']++;
                                $emptyCk++;
                            } else {
                                if ($studentAnswers[$key] == $correctKey) {
                                    $soalDetails['correctCount']++;
                                    $trueCk++;
                                } elseif ($studentAnswers[$key] != $correctKey) {
                                    $soalDetails['incorrectCount']++;
                                    $falseCk++;
                                }
                                switch ($studentAnswers[$key]){
                                    case 1:
                                        $soalDetails['optionACount']++;
                                        break;
                                    case 2:
                                        $soalDetails['optionBCount']++;
                                        break;
                                    case 3:
                                        $soalDetails['optionCCount']++;
                                        break;
                                    case 4:
                                        $soalDetails['optionDCount']++;
                                        break;
                                }
                            }
                            array_push($last,$soalDetails);
                        }else{
                            if ($testedCount>=2){
                                $soalDetails['soalNumber']=$key;
                                $soalDetails['soalKey']=$correctKey;
                                if (!array_key_exists($key, $studentAnswers)) {
                                    $soalDetails['uncheckedCount']++;
                                    $emptyCk++;
                                } else {
                                    if ($studentAnswers[$key] == $correctKey) {
                                        $soalDetails['correctCount']++;
                                        $trueCk++;
                                    } elseif ($studentAnswers[$key] != $correctKey) {
                                        $soalDetails['incorrectCount']++;
                                        $falseCk++;
                                    }
                                    switch ($studentAnswers[$key]){
                                        case 1:
                                            $soalDetails['optionACount']++;
                                            break;
                                        case 2:
                                            $soalDetails['optionBCount']++;
                                            break;
                                        case 3:
                                            $soalDetails['optionCCount']++;
                                            break;
                                        case 4:
                                            $soalDetails['optionDCount']++;
                                            break;
                                    }
                                }
                                $last[$key-1]['uncheckedCount']+=$soalDetails['uncheckedCount'];
                                $last[$key-1]['correctCount']+=$soalDetails['correctCount'];
                                $last[$key-1]['incorrectCount']+=$soalDetails['incorrectCount'];
                                $last[$key-1]['optionACount']+=$soalDetails['optionACount'];
                                $last[$key-1]['optionBCount']+=$soalDetails['optionBCount'];
                                $last[$key-1]['optionCCount']+=$soalDetails['optionCCount'];
                                $last[$key-1]['optionDCount']+=$soalDetails['optionDCount'];
                            }
                        }
                    }
                } else {
                    $testedNotAnswerCount++;
                    $emptyCk = $azmoon->soal->soal_count;
                }
            }
            $bookData = [
                'book_id'=>$book->id,
                'book_name'=>$book->book_name,
                'studentCount'=>$studentCount,
                'testedCount'=>$testedCount,
                'results'=>$last
            ];
            array_push($lastData,$bookData);
           // return $lastData;
            return response()->json(['last_data' => $lastData,'studentCount'=>$studentCount,'testedCount'=>$testedCount]);
        } else {
            $porseshnames = $azmoon->advancedPorseshnamehs;

            $porseshnamesCount = count($porseshnames);
            $porseshnamesLoop=0;
            if ($porseshnames->isNotEmpty()){
                foreach ($porseshnames as $porseshname) {

                    $porseshnamesLoop++;
                    $last=[];

                    $book=$porseshname->book;
                    $correctKeys = null;
                    if ($porseshname) {
                        $keyExp = explode(',', $porseshname->correct_key);
                        $correctKeys = $this->makeArrays($keyExp);
                    }
                    $advancedresults = AzmoonAdvancedResult::query()
                        ->where('azmoon_id',$azmoon->id)
                        ->where('book_id',$porseshname->book_id)
                        ->get();

                    $testedCount = 0;$testedNotAnswerCount = 0;$testedAnswerCount = 0;
                    foreach ($advancedresults as $azmoonResult) {
                        $testedCount++;
                        $resultExp = explode(',', $azmoonResult->result);
                        if ($resultExp[0] != "") {
                            $testedAnswerCount++;
                            $studentAnswers = $this->makeArrays($resultExp);
                            $checkedCount=0;
                            foreach ($correctKeys as $key => $correctKey) {
                                $soalDetails = [
                                    'soalNumber' => 0,
                                    'soalKey' => 0,
                                    'uncheckedCount' => 0,
                                    'correctCount' => 0,
                                    'incorrectCount' => 0,
                                    'optionACount' => 0,
                                    'optionBCount' => 0,
                                    'optionCCount' => 0,
                                    'optionDCount' => 0,
                                    'percent' => 0
                                ];

                                $checkedCount++;
                                if ($testedCount==1){
                                    $soalDetails['soalNumber']=$key;
                                    $soalDetails['soalKey']=$correctKey;

                                    if (!array_key_exists($key, $studentAnswers)) {
                                        $soalDetails['uncheckedCount']++;
                                    } else {
                                        if ($studentAnswers[$key] == $correctKey) {
                                            $soalDetails['correctCount']++;
                                        } elseif ($studentAnswers[$key] != $correctKey) {
                                            $soalDetails['incorrectCount']++;
                                        }
                                        switch ($studentAnswers[$key]){
                                            case 1:
                                                $soalDetails['optionACount']++;
                                                break;
                                            case 2:
                                                $soalDetails['optionBCount']++;
                                                break;
                                            case 3:
                                                $soalDetails['optionCCount']++;
                                                break;
                                            case 4:
                                                $soalDetails['optionDCount']++;
                                                break;
                                        }
                                    }

                                    //return $soalDetails;
                                    array_push($last,$soalDetails);

                                }else{
                                    if ($testedCount>=2){
                                        $soalDetails['soalNumber']=$key;
                                        $soalDetails['soalKey']=$correctKey;
                                        if (!array_key_exists($key, $studentAnswers)) {
                                            $soalDetails['uncheckedCount']++;
                                        } else {
                                            if ($studentAnswers[$key] == $correctKey) {
                                                $soalDetails['correctCount']++;
                                            } elseif ($studentAnswers[$key] != $correctKey) {
                                                $soalDetails['incorrectCount']++;
                                            }
                                            switch ($studentAnswers[$key]){
                                                case 1:
                                                    $soalDetails['optionACount']++;
                                                    break;
                                                case 2:
                                                    $soalDetails['optionBCount']++;
                                                    break;
                                                case 3:
                                                    $soalDetails['optionCCount']++;
                                                    break;
                                                case 4:
                                                    $soalDetails['optionDCount']++;
                                                    break;
                                            }
                                        }
                                        $last[$key-1]['uncheckedCount']+=$soalDetails['uncheckedCount'];
                                        $last[$key-1]['correctCount']+=$soalDetails['correctCount'];
                                        $last[$key-1]['incorrectCount']+=$soalDetails['incorrectCount'];
                                        $last[$key-1]['optionACount']+=$soalDetails['optionACount'];
                                        $last[$key-1]['optionBCount']+=$soalDetails['optionBCount'];
                                        $last[$key-1]['optionCCount']+=$soalDetails['optionCCount'];
                                        $last[$key-1]['optionDCount']+=$soalDetails['optionDCount'];
                                    }
                                }
                            }
                        } else {
                            $testedNotAnswerCount++;
                        }

                    }
                    $bookData = [
                        'book_id'=>$book->id,
                        'book_name'=>$book->book_name,
                        'studentCount'=>$studentCount,
                        'testedCount'=>$testedCount,
                        'results'=>$last
                    ];

                    array_push($lastData,$bookData);
                }

            }
            return response()->json(['last_data' => $lastData,'studentCount'=>$studentCount,'testedCount'=>$testedCount]);
        }
    }
}
