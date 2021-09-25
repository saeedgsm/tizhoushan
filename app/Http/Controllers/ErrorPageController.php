<?php


namespace App\Http\Controllers;


class ErrorPageController extends Controller
{
    public function canceled()
    {
        return view('errors.canceled',[
            'title' => 'تراکنش ناموفق',
            'message'   => 'تراکنش خود را لغو کرده اید!',
            'code'      => '401'
        ]);
    }

}