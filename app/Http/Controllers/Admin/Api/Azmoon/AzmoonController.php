<?php


namespace App\Http\Controllers\Admin\Api\Azmoon;


use App\Azmoon;
use App\AzmoonAdvancedResult;
use App\AzmoonBook;
use App\AzmoonClass;
use App\AzmoonResult;
use App\AzmoonSoalat;
use App\Http\Controllers\Controller;
use App\Traits\OptionTrait;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use http\Env\Response;
use Illuminate\Http\Request;


class AzmoonController extends Controller
{
    use OptionTrait;
    public function index()
    {
        $azmoons = Azmoon::query()->latest()->get();
        $data = [];
        if ($azmoons->isNotEmpty()) {
            foreach ($azmoons as $azmoon) {
                $data[] = [
                    'id' => $azmoon->id,
                    'azmoon_title' => $azmoon->azmoon_title,
                    'azmoon_for' => $azmoon->azmoon_for === 'exam' ? 'امتحان' : 'نظرستجی',
                    'azmoon_type' => $azmoon->azmoon_type == 'normal' ? 'عادی' : 'پیشرفته',
                    'azmoon_start' => convertNumbers(Verta::instance($azmoon->azmoon_start)->format('H:i Y/m/d ')),
                ];
            }
        }
        $results = $this->paginate($data);
        $results->withPath(url()->current());
        return response()->json($results);
    }

    public function store(Request $request)
    {
        if ($request['azmoon_code'] == '') {
            $azmoonCode = Azmoon::azmoonCodeGenerates();
        } else {
            $azmoonCode = $request['azmoon_code'];
        }
        $azmoonData = [
            'azmoon_type' => $request['azmoon_type'],
            'azmoon_code' => $azmoonCode,
            'azmoon_title' => $request['azmoon_title'],
            'price' => $request['price'],
            'type_payment' => $request['type_payment'],
            'azmoon_for' => $request['azmoon_for'],
            'azmoon_nomreh' => $request['azmoon_nomreh'],
            'azmoon_start' => $request['start_date'],
            'azmoon_end' => $request['end_date'],
            'azmoon_time' => $request['azmoon_time'],
            'azmoon_sync' => $request['azmoon_sync'],
            'azmoon_sync_time' => $request['azmoon_sync_time'],
            'class_type' => $request['class_type'],
        ];
        $azmoon = Azmoon::create($azmoonData);

        if ($request['class_type'] == 'elective') {
            foreach ($request['class_id'] as $eachBookId) {
                AzmoonClass::create([
                    'azmoon_id' => $azmoon->id,
                    'educational_class_id' => $eachBookId['id'],
                ]);
            }
        }

        if ($request['azmoon_type'] == "normal") {
            AzmoonBook::create([
                'azmoon_id' => $azmoon->id,
                'book_id' => $request['book_id'],
                'azmoon_type' => $request['azmoon_type'],
            ]);
        } else {
            foreach ($request['book_id'] as $eachBookId) {
                AzmoonBook::create([
                    'azmoon_id' => $azmoon->id,
                    'book_id' => $eachBookId['id'],
                    'azmoon_type' => $request['azmoon_type'],
                ]);
            }
        }

        $soal = [
            'azmoon_id' => $azmoon->id,
            'type' => $request['type'],
            'soal_count' => $request['soal_count'],
            'answer_type' => $request['answer_type'],
        ];
        AzmoonSoalat::create($soal);
        return response()->json($azmoon);
    }

    public function show($azmoonId)
    {
        $azmoonData = Azmoon::find($azmoonId);
        // $azmoon_start = new Verta($azmoonData->azmoon_start);
        //  $dt = Carbon::now();
        $azmoon_link = asset("azmoon/start/" . $azmoonData->azmoon_code);
        $azmoon_start = convertNumbers(Verta::instance($azmoonData->azmoon_start)->format('H:i Y/m/d '));
        $azmoon_end = convertNumbers(Verta::instance($azmoonData->azmoon_end)->format('H:i Y/m/d '));
        $azmoon = [
            'id' => $azmoonData->id,
            'azmoon_status' => $azmoonData->azmoon_status,
            'azmoon_title' => $azmoonData->azmoon_title,
            'azmoon_type' => $azmoonData->azmoon_type,
            'price' => $azmoonData->price,
            'type_payment' => $azmoonData->type_payment,
            'azmoon_start' => $azmoon_start,
            'azmoon_end' => $azmoon_end,
            'azmoon_code' => $azmoonData->azmoon_code,
            'azmoon_link' => $azmoon_link,
            'azmoon_sync' => $azmoonData->azmoon_sync,
            'azmoon_sync_time' => $azmoonData->azmoon_sync_time,
            'class_type' => $azmoonData->class_type,
        ];
        $soal = [
            'soal_type' => $azmoonData->soal->type,
            'soal_count' => $azmoonData->soal->soal_count,
            'answer_type' => $azmoonData->soal->answer_type,
        ];

        $book_data = $azmoonData->azmoonBooks;
        $books = [];
        foreach ($book_data as $book) {
            $books[] = [
                'book_name' => $book->book->book_name,
                'id' => $book->book->id,
            ];
        }
        return response()->json(['azmoon' => $azmoon, 'books' => $books, 'soal' => $soal]);
    }

    public function edit($azmoonId)
    {
        $azmoonData = Azmoon::find($azmoonId);
        $book_data = $azmoonData->azmoonBooks;
        $soal = [
            'soal_type' => $azmoonData->soal->type,
            'soal_count' => $azmoonData->soal->soal_count,
            'answer_type' => $azmoonData->soal->answer_type,
        ];
        $books = [];
        foreach ($book_data as $book) {
            $books[] = [
                'book_name' => $book->book->book_name,
                'id' => $book->book->id,
            ];
        }
        return response()->json(['azmoon' => $azmoonData, 'books' => $books, 'soal' => $soal]);
    }

    public function date_edit($azmoonId)
    {
        $azmoonData = Azmoon::find($azmoonId);
        $azmoon_date['start'] = convertNumbers(Verta::instance($azmoonData->azmoon_start)->format('H:i Y/m/d '));
        $azmoon_date['end'] = convertNumbers(Verta::instance($azmoonData->azmoon_end)->format('H:i Y/m/d '));
        return response()->json(['azmoon' => $azmoonData, 'azmoon_date' => $azmoon_date]);
    }

    public function date_update(Request $request)
    {
        $azmoon = Azmoon::query()->where('id', $request['azmoon_id'])->first();
        $azmoon->update([
            'azmoon_start' => $request['new_date']['start_date'],
            'azmoon_end' => $request['new_date']['end_date'],
            'azmoon_time' => $request['new_date']['azmoon_time'],
        ]);

        return 'success';
    }

    public function update(Request $request)
    {
        $azmoon = Azmoon::query()->where('id', $request['azmoon']['id'])->first();
        $azmoon->update([
            'azmoon_type' => $request['azmoon']['azmoon_type'],
            'azmoon_sync' => $request['azmoon']['azmoon_sync'],
            'azmoon_sync_time' => $request['azmoon']['azmoon_sync_time'],
            'azmoon_title' => $request['azmoon']['azmoon_title'],
            'azmoon_code' => $request['azmoon']['azmoon_code'],
            'type_payment' => $request['azmoon']['type_payment'],
            'price' => $request['azmoon']['price'],
        ]);
        $soal = $azmoon->soal;
        $soal->update([
            'type' => $request['soal']['soal_type'],
            'soal_count' => $request['soal']['soal_count'],
            'answer_type' => $request['soal']['answer_type'],
        ]);
        return $request->all();
    }

    public function destroy($id)
    {
        $azmoon = Azmoon::findOrFail($id);

        //$currentPhoto = $azmoon->soal->soal_cover;

        // $userPhoto = public_path('img/profile/').$currentPhoto;
        /*$userPhoto = asset($azmoon->soal->soal_cover);

        if(file_exists($userPhoto)) {
            @unlink($userPhoto);
        }*/
        $azmoon->delete();

        //  Azmoon::destroy($azmoon);
        return 'success';
    }

    public function changeStatus($id)
    {
        $azmoon = Azmoon::findOrFail($id);
        if ($azmoon->azmoon_status == 1) {
            $azmoon->update(['azmoon_status' => 0]);
        } else {
            $azmoon->update(['azmoon_status' => 1]);
        }
        return $azmoon;
    }

    public function resetAzmoon($id)
    {
        $azmoon = Azmoon::findOrFail($id);
        if ($azmoon->azmoon_type == 'normal') {
            $results = AzmoonResult::where('azmoon_id', $azmoon->id)->get();
        } elseif ($azmoon->azmoon_type == 'advanced') {
            $results = AzmoonAdvancedResult::where('azmoon_id', $azmoon->id)->get();
        }


        $msg['type'] = '';
        $msg['message'] = '';
        if ($results->isNotEmpty()) {
            foreach ($results as $result) {
                $result->delete();
            }
            $msg['type'] = 'success';
            $msg['message'] = 'اطلاعات آزمون شرکت کنندگان ریست شد!';
        } else {
            $msg['type'] = 'success';
            $msg['message'] = 'اطلاعات آزمون شرکت کنندگان خالی است!';
        }
        return response($msg);
    }
}
