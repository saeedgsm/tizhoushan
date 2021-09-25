@extends('panel.admin.master')
@section('page_title')افزودن محصول جدید@endsection

@section('script')
    <script>
        $(document).ready(function () {
            let price = document.querySelector('#price');
            document.querySelector('#product_type_payment1').addEventListener('change',function () {
                if (this.checked === true){
                    price.classList.add("d-none")
                }
            });
            document.querySelector('#product_type_payment2').addEventListener('change',function () {
                if (this.checked === true){
                    price.classList.remove("d-none")
                }
            })
        });
    </script>


    <script src="https://cdn.ckeditor.com/4.14.1/full-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('product_body' ,{
            filebrowserUploadUrl : '/ck-editor/upload-image',
            filebrowserImageUploadUrl :  '/ck-editor/upload-image'
        });
    </script>

@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1"> محصول </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم افزودن محصول جدید</li>
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
                                <h3 class="header-title"> فرم افزودن محصول</h3>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="product_category_id">دسته بندی محصول </label>
                                                <select autofocus class="form-control  @error('product_category_id') is-invalid @enderror" name="product_category_id" id="product_category_id">
                                                    <option selected disabled>لطفا انتخاب کنید!</option>
                                                    @foreach($parentCategories as $parent)
                                                        <option value="{{ $parent->id }}" class="btn btn-info" disabled>{{ $parent->product_category_name }}</option>
                                                        @if($children = $parent->childrenCategories()->get())
                                                            @foreach($children as $sub)
                                                                <option value="{{ $sub->id }}">  --  {{ $sub->product_category_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="product_name">عنوان محصول</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="product_name"
                                                   value="{{ old('product_name') }}"
                                                   id="product_name" placeholder="عنوان محصول را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان محصول را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="product_latin"><span>عنوان محصول </span> <span class="text-danger">به لاتین</span></label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="product_latin"
                                                   value="{{ old('product_latin') }}"
                                                   id="product_latin" placeholder="عنوان محصول را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان محصول را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="product_label"><span>لیبل محصول </span></label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="product_label"
                                                   value="{{ old('product_label') }}"
                                                   id="product_label" placeholder="لیبل محصول را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">لیبل محصول را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="product_body"><span>توضیحات محصول </span></label>
                                            <textarea type="text"
                                                   class="form-control"
                                                   name="product_body"
                                                   rows="8"
                                                      id="product_body" placeholder="توضیحات محصول را وارد کنید">{{ old('product_body') }}</textarea>
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">توضیحات محصول را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-3 mb-3">
                                            <h5 class="font-size-14">نوع محصول</h5>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="product_type2" name="product_type" value="physical"
                                                       class="custom-control-input @error('product_type') is-invalid @enderror">
                                                <label class="custom-control-label" for="product_type2">فیزیکی</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="product_type3" name="product_type" value="virtual"
                                                       class="custom-control-input @error('product_type') is-invalid @enderror" checked="">
                                                <label class="custom-control-label" for="product_type3">مجازی</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <h5 class="font-size-14">وضعیت دسترسی فروش </h5>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="product_status2" name="product_status" value="1"
                                                       class="custom-control-input @error('product_status') is-invalid @enderror">
                                                <label class="custom-control-label" for="product_status2">فعال</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="product_status3" name="product_status" value="0"
                                                       class="custom-control-input @error('product_status') is-invalid @enderror" checked="">
                                                <label class="custom-control-label" for="product_status3">غیر
                                                    فعال</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-3">
                                            <h5 class="font-size-14">نوع هزینه </h5>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="product_type_payment1" name="product_type_payment"
                                                       value="free"
                                                       class="custom-control-input">
                                                <label class="custom-control-label" for="product_type_payment1">رایگان</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="product_type_payment2" name="product_type_payment" value="cash"
                                                       class="custom-control-input">
                                                <label class="custom-control-label" for="product_type_payment2">پولی</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-3 d-none" id="price">
                                            <label for="price">هزینه محصول تومان<span class="text-danger"> به تومان </span></label>
                                            <input type="text" title="هزینه محصول به تومان وارد کنید!"
                                                   class="form-control"
                                                   name="product_price" autocomplete="off"
                                                   value="{{ old('product_price') }}"
                                                   id="price" placeholder="هزینه محصول را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">هزینه محصول را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <label>کاور محصول </label>
                                            <div class="custom-file">
                                                <input type="file" class="form-control-file" name="product_image"
                                                       id="product_image">
                                            </div>
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
