<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    public function index()
    {
        $categories = TicketCategory::query()->orderBy('ticket_category_name','asc')->paginate('20');
        return view('panel.admin.ticketCategories.all',compact('categories'));
    }

    public function create()
    {
        return view('panel.admin.ticketCategories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ticket_category_name'=>['required','string' , 'max:191',],
            'ticket_category_latin'=>['required','string' , 'max:191',],
        ]);

        TicketCategory::create($request->all());
        return redirect(route('admin.ticketCategories.index'))->with('success','دسته بندی تیکت با موفقیت ثبت گردید!');
    }

    public function edit(TicketCategory $ticketCategory)
    {
        return view('panel.admin.ticketCategories.edit',compact('ticketCategory'));
    }

    public function update(Request $request, TicketCategory $ticketCategory)
    {
        $request->validate([
            'ticket_category_name'=>['required','string' , 'max:191',],
            'ticket_category_latin'=>['required','string' , 'max:191',],
        ]);

        $ticketCategory->update($request->all());
        return redirect(route('admin.ticketCategories.index'))->with('success','دسته بندی تیکت با موفقیت ویرایش گردید!');
    }

    public function destroy(TicketCategory $ticketCategory)
    {
        $ticketCategory->delete();
        return redirect(route('admin.ticketCategories.index'))->with('success','دسته بندی تیکت با موفقیت حذف گردید!');
    }
}
