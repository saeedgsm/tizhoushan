<?php


namespace App\Http\Controllers\Admin\Api\Book;


use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function books()
    {
        $books = Book::query()->latest()->get();
        $allBooks = [];
        foreach ($books as $value) {
            $bases = $value->bases;
            array_push($allBooks, [
                'book_name' => $value->book_name,
                'zarib' => $value->zarib,
                'nomreh_manfi' => $value->nomreh_manfi,
                'nomreh' => $value->nomreh,
                'bases' => $bases
            ]);
        }
        return response(['books' => $books]);
    }

    public function store(Request $request)
    {
        $bases = $request['base'];
        $ids = [];
        foreach ($bases as $base) {
            array_push($ids, $base['id']);
        }
        $inputs = [
            'book_name' => $request['book_name'],
            'zarib' => $request['zarib'],
            'nomreh_manfi' => $request['nomreh_manfi'],
            'nomreh' => $request['nomreh'],
        ];
        $book=Book::create($inputs);
        $book->bases()->sync($ids);
        $book['bases'] = $book->bases;
        return response(['book'=>$book]);
    }

    public function update(Request $request)
    {
        $bases = $request['bases'];
        $ids = [];
        foreach ($bases as $base) {
            array_push($ids, $base['id']);
        }
        $inputs = [
            'book_name' => $request['book_name'],
            'zarib' => $request['zarib'],
            'nomreh_manfi' => $request['nomreh_manfi'],
            'nomreh' => $request['nomreh'],
        ];
        $book = Book::find($request['id']);
        $book->update($inputs);
        $book->bases()->sync($ids);
        return $book;
    }

    public function destroy($bookId)
    {
        $errormsg=null;
        try {
            $book=Book::find($bookId);
            $book->delete();
            $icon='success';
            $title='عملیات موفقیت آمیز';
            $text='کتاب با موفقیت حذف گردید!';
        }catch (\Throwable $th){
            $icon='error';
            $title='خطا!';
            $text='عملیات با مشکل روبرو شد';
            $errormsg=$th->getMessage();
        }
        return response([
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
            'error'=>$errormsg
        ]);
    }
}
