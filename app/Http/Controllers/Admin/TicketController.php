<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Ticket;
use App\TicketCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->paginate(20);
        return view('panel.admin.tickets.all',compact('tickets'));
    }

    public function create()
    {
        $categories = TicketCategory::query()->orderBy('ticket_category_name','asc')->get();
        $users = User::query()->whereIn('level',['student','teacher'])->orderBy('last_name')->get();
        return view('panel.admin.tickets.create',compact('categories','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>['required'],
            'category_id'=>['required'],
            'title'=>['required','string','min:2','max:30'],
            'priority'=>['required'],
            'message'=>['required','string','min:5','max:191'],
        ]);
        $inputs = [
            'user_id'=>$request['user_id'],
            'category_id'=>$request['category_id'],
            'ticket_code'=>strtolower(Str::random(10)),
            'title'=>$request['title'],
            'priority'=>$request['priority'],
            'message'=>$request['priority'],
            'status' => "open"
        ];
        Ticket::create($inputs);
        return redirect(route('admin.tickets.index'))->with('success','تیکت با موفقیت ارسال گردید!');
    }
}
