<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::query()->orderBy('product_category_order', 'asc')->paginate('20');
        return view('panel.admin.product.productCategories.all', compact('categories'));
    }

    public function create()
    {
        $parentCategories = ProductCategory::query()
            ->whereNull('parent_id')
            ->orderBy('product_category_order', 'asc')
            ->get();
        return view('panel.admin.product.productCategories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_category_name' => ['required', 'string', 'max:191',],
            'product_category_latin' => ['required', 'string', 'max:191',],
            'product_category_order' => ['required', 'numeric',],
        ]);

        ProductCategory::create($request->all());
        return redirect(route('admin.productCategories.index'))->with('success', 'دسته بندی محصول با موفقیت ثبت گردید!');
    }

    public function edit(ProductCategory $productCategory)
    {
        $parentCategories = ProductCategory::query()
            ->whereNull('parent_id')
            ->orderBy('product_category_order', 'asc')
            ->get();
        return view('panel.admin.product.productCategories.edit', compact('productCategory','parentCategories'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'product_category_name' => ['required', 'string', 'max:191',],
            'product_category_latin' => ['required', 'string', 'max:191',],
            'product_category_order' => ['required', 'numeric',],
        ]);

        $productCategory->update($request->all());
        return redirect(route('admin.productCategories.index'))->with('success', 'دسته بندی محصول با موفقیت ویرایش گردید!');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return redirect(route('admin.productCategories.index'))->with('success', 'دسته بندی محصول با موفقیت حذف گردید!');
    }
}
