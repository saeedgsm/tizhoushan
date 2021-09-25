@extends('panel.admin.master')
@section('page_title')افزودن گزینه سوالات@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">گزینه سوالات آزمون </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم افزودن گزینه سوال جدید</li>
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
                                <h4 class="header-title"> فرم افزودن سوال</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.soalbsoals.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="azmoon_id" value="{{ $azmoon->id }}">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="title">عنوان</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="title"
                                                   value="{{ old('title') }}"
                                                   id="title" placeholder="عنوان را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label>تصویر </label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image"
                                                       id="validationCustomFile1">
                                                <label class="custom-file-label" for="validationCustomFile">انتخاب
                                                    تصویر...</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label>فایل pdf </label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="pdf_file"
                                                       id="validationCustomFile2">
                                                <label class="custom-file-label" for="validationCustomFile">انتخاب
                                                    فایل pdf...</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-3 mb-3 ">
                                            <label for="tik_a">گزینه اول</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="tik_a"
                                                   value="{{ old('tik_a') }}"
                                                   id="tik_a" placeholder="گزینه اول را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">گزینه اول را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tik_b">گزینه دوم</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="tik_b"
                                                   value="{{ old('tik_b') }}"
                                                   id="tik_b" placeholder="گزینه دوم را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">گزینه دوم را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tik_c">گزینه سوم</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="tik_c"
                                                   value="{{ old('tik_c') }}"
                                                   id="tik_c" placeholder="گزینه سوم را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">گزینه سوم را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tik_d">گزینه چهارم</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="tik_d"
                                                   value="{{ old('tik_d') }}"
                                                   id="tik_d" placeholder="گزینه چهارم را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">گزینه چهارم را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="key"> گزینه درست </label>
                                                <select autofocus class="form-control  @error('key') is-invalid @enderror" name="key" id="key">
                                                    <option selected disabled>لطفا انتخاب کنید!</option>
                                                    <option value="a">گزینه اول</option>
                                                    <option value="b">گزینه دوم</option>
                                                    <option value="c">گزینه سوم</option>
                                                    <option value="d">گزینه چهارم</option>
                                                </select>
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
