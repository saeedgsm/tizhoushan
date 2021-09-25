<?php

namespace App\Http\Controllers\Admin;

use App\Azmoon;
use App\AzmoonAdvancePorseshnameh;
use App\AzmoonBook;
use App\AzmoonResult;
use App\AzmoonSoalat;
use App\Book;
use App\Exports\AzmoonReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\AzmoonRequest;
use App\RegisterClassStudent;
use App\Traits\DefaultCoverTrait;
use App\Traits\OptionTrait;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;


class AzmoonController extends Controller
{
    use DefaultCoverTrait,OptionTrait;

    public function index()
    {
        $azmoons = Azmoon::latest()->paginate(20);
        return view('panel.admin.azmoons.all', compact('azmoons'));
    }

    public function create()
    {
        $books = Book::all();
        return view('panel.admin.azmoons.create', compact('books'));
    }

    public function store(AzmoonRequest $request)
    {
        if ($request['azmoon_code'] == '') {
            $azmoonCode = Azmoon::azmoonCodeGenerates();
        } else {
            $azmoonCode = $request['azmoon_code'];
        }
        $start_date = Carbon::createFromTimestamp(intval(substr($request['start_date'], 0, -3)), "asia/tehran")->toDateTimeString();
        $end_date = Carbon::createFromTimestamp(intval(substr($request['end_date'], 0, -3)), "asia/tehran")->toDateTimeString();

        $azmoonData = [
            'azmoon_type' => $request['azmoon_type'],
            'azmoon_code' => $azmoonCode,
            'azmoon_title' => $request['azmoon_title'],
            'price' => $request['price'],
            'type_payment' => $request['type_payment'],
            'azmoon_nomreh' => $request['azmoon_nomreh'],
            'azmoon_start' => $start_date,
            'azmoon_end' => $end_date,
            'azmoon_time' => $request['azmoon_time'],
            'azmoon_sync' => $request['azmoon_sync'],
            'azmoon_sync_time' => $request['azmoon_sync_time'],
        ];

        $azmoon = Azmoon::create($azmoonData);

        foreach ($request['book_id'] as $eachBookId) {
            AzmoonBook::create([
                'azmoon_id' => $azmoon->id,
                'book_id' => $eachBookId,
                'azmoon_type' => $request['azmoon_type'],
            ]);
        }

        $fileCover = $request->file('soal_cover');
        $cover = null;
        if ($fileCover) {
            $cover = $this->uploadFiles($fileCover, 'soal_cover');
        }
        $soal = [
            'azmoon_id' => $azmoon->id,
            'type' => $request['type'],
            'soal_cover' => $cover,
            'soal_count' => $request['soal_count'],
            'answer_type' => $request['answer_type'],
        ];
        AzmoonSoalat::create($soal);
        return redirect(route('admin.azmoons.show', $azmoon))->with('success', 'آزمون با موفقیت ایجاد شد.');
    }

    public function show(Azmoon $azmoon)
    {
        $soal = $azmoon->soal()->first();
        $files = $azmoon->soalatFiles()->oldest()->get();

        // normal
        $porseshnames = $azmoon->porseshnamehs()->first();
        $soalbsoals = $azmoon->soalbsoals()->get();

        $correctKeys = null;
        if ($porseshnames) {
            $keyExp = explode(',', $porseshnames->correct_key);
            $correctKeys = $this->makeArrays($keyExp);
        }

        // advanced
        $advancedPorseshnamehs = AzmoonAdvancePorseshnameh::query()->where('azmoon_id', $azmoon->id)->get();

        $azmoonBooks = $azmoon->azmoonBooks;
        $soalBooks = array();
        foreach ($azmoonBooks as $azmoonBook) {
            $check = AzmoonAdvancePorseshnameh::query()->where('azmoon_id', $azmoon->id)->where('book_id', $azmoonBook->book_id)->first();
            if (!$check) {
                array_push($soalBooks, $azmoonBook->book);
            }
        }

        $azmoonDate['start'] = $this->convertNumbers(new Verta($azmoon->azmoon_start));
        $azmoonDate['end'] = $this->convertNumbers(new Verta($azmoon->azmoon_end));

        $azmoon_cover = $this->checkDefaultImage($soal->soal_cover,'azmoon_cover');

        return view('panel.admin.azmoons.show', compact(
            'azmoon', 'soal', 'files','porseshnames', 'soalbsoals',
            'advancedPorseshnamehs', 'soalBooks', 'azmoonDate', 'correctKeys',
            'azmoon_cover'
        ));
    }

    public function edit(Azmoon $azmoon)
    {
        $soal = AzmoonSoalat::where('azmoon_id', $azmoon->id)->first();
        $books = Book::all();
        return view('panel.admin.azmoons.edit', compact('azmoon', 'books', 'soal'));
    }

    public function update(Request $request, Azmoon $azmoon)
    {

        $request->validate([
            'book_id' => 'required',
            'azmoon_type' => 'required|in:normal,advanced',
            'azmoon_title' => 'required|min:2|max:90',
            'type_payment' => 'required|',
            'azmoon_sync_time' => 'nullable|numeric',

            'price' => 'nullable|numeric',
            'type' => 'required|',
            'soal_count' => 'required|',
            'answer_type' => 'required|',
            'soal_cover' => 'nullable|',
        ]);

        $azmoonData = [
            'azmoon_type' => $request['azmoon_type'],
            'azmoon_title' => $request['azmoon_title'],
            'price' => $request['price'],
            'azmoon_start' => $azmoon->azmoon_start,
            'azmoon_end' => $azmoon->azmoon_end,
            'azmoon_time' => $azmoon->azmoon_time,
            'type_payment' => $request['type_payment'],
            'azmoon_nomreh' => $request['azmoon_nomreh'],
            'azmoon_sync' => $request['azmoon_sync'],
            'azmoon_sync_time' => $request['azmoon_sync_time'],
        ];

        $azmoon->update($azmoonData);

        $azmoon->azmoonBooks()->delete();
        foreach ($request['book_id'] as $eachBookId) {
            AzmoonBook::create([
                'azmoon_id' => $azmoon->id,
                'book_id' => $eachBookId,
                'azmoon_type' => $request['azmoon_type'],
            ]);
        }

        $fileCover = $request->file('soal_cover');
        $cover = null;
        $soal = $azmoon->soal()->first();
        if ($fileCover) {
            $cover = $this->uploadFiles($fileCover, 'soal_cover');
        } else {

            $cover = $soal->soal_cover;
        }

        $soalData = [
            'type' => $request['type'],
            'soal_cover' => $cover,
            'soal_count' => $request['soal_count'],
            'answer_type' => $request['answer_type'],
        ];

        $soal->update([
            'type' => $request['type'],
            'soal_cover' => $cover,
            'soal_count' => $request['soal_count'],
            'answer_type' => $request['answer_type'],
        ]);

        return redirect(route('admin.azmoons.show', $azmoon))->with('success', 'اطلاعات آزمون با موفقیت ویرایش گردید!');

    }

    public function editDate(Azmoon $azmoon)
    {
        $azmoonDate['start'] = $this->convertNumbers(new Verta($azmoon->azmoon_start));
        $azmoonDate['end'] = $this->convertNumbers(new Verta($azmoon->azmoon_end));
        return view('panel.admin.azmoons.editDate', compact('azmoon', 'azmoonDate'));
    }

    public function updateDate(Request $request, Azmoon $azmoon)
    {
        $start_date = Carbon::createFromTimestamp(intval(substr($request['start_date'], 0, -3)), "asia/tehran")->toDateTimeString();
        $end_date = Carbon::createFromTimestamp(intval(substr($request['end_date'], 0, -3)), "asia/tehran")->toDateTimeString();
        $azmoon->update([
            'azmoon_start' => $start_date,
            'azmoon_end' => $end_date,
            'azmoon_time' => $request['azmoon_time']
        ]);
        return redirect(route('admin.azmoons.show', $azmoon))->with('success', 'با موفقیت تاریخ آزمون ویرایش گردید!');
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

    public function destroy(Azmoon $azmoon)
    {
        try {
            $azmoon->delete();
        } catch (\Exception $e) {
        }
        return redirect(route('admin.azmoons.index'))->with('success', 'آزمون با موفقیت حذف شد.');
    }

    public function uploadFiles($file, $folder)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;

        $filename = Carbon::now()->timestamp . '.' . $file->getClientOriginalExtension();
        $dir = 'upload/' . $folder . '/' . $year . '/' . $month . '/' . $day . '/';
        $file->move(public_path($dir), $filename);
        return $dir . $filename;
    }

    public function resultReset($azmoon)
    {
        $results = AzmoonResult::where('azmoon_id', $azmoon)->get();
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

    public function exportReport(Azmoon $azmoon)
    {
        return Excel::download(new AzmoonReport($azmoon), 'azmoon_reports.xlsx');
    }

    public function quickReport(Azmoon $azmoon, $ty)
    {
        $page_header = '';
        switch ($ty) {
            case 'testing':
                $page_header = "در حال آزمون";
                break;
            case 'completed':
                $page_header = "شرکت کنندگان";
                break;
            case 'absent':
                $page_header = "غائبین";
                break;
            case 'incomplete':
                $page_header = "نا تمام";
                break;
        }
        $page = 10;
        $q = '';
        $perPage = 10;
        $orderBy = 'asc';

        $countStudents = 0;
        $date = \Carbon\Carbon::today()->subHours(24);
        $results = array();
        if ($ty == 'absent') {
            $azmoonBooks = $azmoon->azmoonBooks()->get();
            foreach ($azmoonBooks as $book) {
                $bases = $book->book->bases;

                $azmoonInStudents = AzmoonResult::query()->where('azmoon_id', $azmoon->id)->whereIn('status', ['testing', 'completed'])->get();

                foreach ($bases as $base) {
                    $allStudents = RegisterClassStudent::query()->where('base_id', $base->id)->get();
                    //reports for dev
                    // print_r($allStudents->count());
                    //echo '<br>';
                    //print_r($base->base_title);
                    //echo '<hr>';
                    //$countAllStudents = $allStudents->count();
                    foreach ($allStudents as $allStudent) {
                        $check = $azmoonInStudents->where('user_id', $allStudent->user_id)->first();
                        if ($check == null) {
                            array_push($results, $allStudent);

                        }
                    }
                }

                $countStudents = count($results);
                $results = $this->paginate($results);
                $results->withPath(url()->current());
            }


        } else {

            $results = AzmoonResult::query()->where('azmoon_id', $azmoon->id)->where('status', $ty)->latest()->get();
            foreach ($results as $result) {
                if ($result->status == 'testing') {
                    $studentStartedTime = $result->start_date;
                    $azmoonTime = $azmoon->azmoon_time;
                    $pastedTime = Carbon::now()->diffInMinutes($studentStartedTime);
                    if ($pastedTime >= $azmoonTime) {
                        $result->update([
                            'status' => 'completed'
                        ]);

                    }
                }
            }

            $results = AzmoonResult::query()->where('azmoon_id', $azmoon->id)->where('status', $ty)->latest()->get();
            $countStudents = count($results);
            $results = $this->paginate($results);
            $results->withPath(url()->current());
        }
        return view('panel.admin.azmoons.quickReport', compact('azmoon', 'results', 'perPage', 'page', 'q', 'orderBy', 'page_header', 'ty', 'countStudents'));
    }

    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function resultResetUser(AzmoonResult $result)
    {
        $result->delete();
        return redirect(url()->previous())->with('success', 'اطلاعات آزمون کاربر با موفقیت ریست گردید!');
    }

    public function changeStatus(Azmoon $azmoon)
    {
        if ($azmoon->azmoon_status == 1) {
            $azmoon->update(['azmoon_status' => 0]);
            $msg = "آزمون با موفقیت غیر فعال شد! دانش آموزان به آزمون دسترسی ندارند!";
        } else {
            $azmoon->update(['azmoon_status' => 1]);
            $msg = "وضعیت آزمون با موفقیت تغییر یافت! دانش آموزان می توانند آزمون بدهند!";
        }
        return redirect(url()->previous())->with('success', $msg);
    }

}
