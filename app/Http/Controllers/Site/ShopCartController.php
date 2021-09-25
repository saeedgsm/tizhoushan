<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ShopCartController extends Controller
{
    public function index()
    {
        $carts = null;
        if (auth()->check()){
            $carts = auth()->user()->shopCarts()->latest()->get();
        }
        return view('site.shopCarts.all',compact('carts'));
    }


}
