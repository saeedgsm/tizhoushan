<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->where('product_status',1)->latest()->paginate(9);
        return view('site.products.all',compact('products'));
    }

    public function show(Product $product)
    {
        return view('site.products.show',compact('product'));
    }
}
