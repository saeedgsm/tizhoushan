@extends('panel.admin.master')
@section('page_title')ویرایش دسته بندی محصول@endsection

@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">دسته بندی محصول </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم ویرایش دسته بندی </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title"> فرم ویرایش دسته بندی</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.productCategories.update',$productCategory) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="parent_id">سرگروه دسته </label>
                                                <select autofocus class="form-control  @error('parent_id') is-invalid @enderror" name="parent_id" id="parent_id">
                                                    <option selected disabled>لطفا انتخاب کنید!</option>
                                                    <option value="" {{ $productCategory->parent_id == null ? 'selected' : '' }}>سرگروه</option>
                                                    @foreach($parentCategories as $parent)
                                                        <option value="{{ $parent->id }}" {{ $parent->id == $productCategory->parent_id ? 'selected' : '' }}>{{ $parent->product_category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="product_category_name">عنوان دسته بندی محصول</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="product_category_name"
                                                   value="{{ old('product_category_name',$productCategory->product_category_name) }}"
                                                   id="product_category_name" placeholder="عنوان دسته بندی محصول را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان دسته بندی محصول را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="product_category_latin"><span>عنوان دسته بندی محصول </span> <span class="text-danger">به لاتین</span></label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="product_category_latin"
                                                   value="{{ old('product_category_latin',$productCategory->product_category_latin) }}"
                                                   id="product_category_latin" placeholder="عنوان دسته بندی محصول را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان دسته بندی محصول را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="product_category_order">ترتیب دسته</label>
                                            <input type="number"
                                                   class="form-control"
                                                   name="product_category_order"
                                                   value="{{ old('product_category_order',$productCategory->product_category_order) }}"
                                                   id="product_category_order" placeholder="ترتیب دسته را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">ترتیب دسته را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mt-4">
                                            <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">
                                                ثبت اطلاعات
                                            </button>
                                            <button type="reset"
                                                    class="btn btn-secondary waves-effect m-l-5">
                                                تازه سازی فرم
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
