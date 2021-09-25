<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductCategory;
use App\Traits\OptionTrait;
use App\Traits\UploaderFile;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use OptionTrait,UploaderFile;

    public function index()
    {
        $products = Product::query()->orderBy('product_name','asc')->paginate(20);
        return view('panel.admin.product.products.all',compact('products'));
    }

    public function create()
    {
        $parentCategories = ProductCategory::query()
            ->whereNull('parent_id')
            ->orderBy('product_category_order', 'asc')
            ->get();
        return view('panel.admin.product.products.create',compact('parentCategories'));
    }

    public function store(ProductRequest $request)
    {
        $inputs = $request->except(['product_image']);
        $file = $request->file('product_image');
        $inputs['product_code'] = $this->createUniqueProductCode();

        if ($file) {
            $inputs['product_image'] = $this->uploadImage($file, 'product_cover');
        }

        Product::create($inputs);
        return redirect(route('admin.products.index'))->with('success','اطلاعات محصول با موفقیت ثبت گردید!');
    }

    public function show(Product $product)
    {
        return view('panel.admin.product.products.show',compact('product'));
    }

    public function edit(Product $product)
    {
        $parentCategories = ProductCategory::query()
            ->whereNull('parent_id')
            ->orderBy('product_category_order', 'asc')
            ->get();
        return view('panel.admin.product.products.edit',compact('product','parentCategories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $inputs = $request->except(['product_image']);
        $file = $request->file('product_image');
        if ($file) {
            if (file_exists(asset($product->product_image)))
                unlink($product->product_image);
            $inputs['product_image'] = $this->uploadImage($file, 'product_cover');
        }else{
            $inputs['product_image'] = $product->product_image;
        }
        $product->update($inputs);
        return redirect(route('admin.products.index'))->with('success','اطلاعات محصول با موفقیت ویرایش گردید!');
    }

    public function destroy(Product $product)
    {
        if (file_exists(asset($product->product_image)))
            unlink($product->product_image);
        $product->delete();
        return redirect(route('admin.products.index'))->with('success','اطلاعات محصول با موفقیت حذف گردید!');
    }

}
