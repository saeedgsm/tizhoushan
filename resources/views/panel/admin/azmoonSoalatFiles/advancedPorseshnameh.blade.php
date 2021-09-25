@extends('panel.admin.master')
@section('page_title')افزودن فایل سوالات@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">فایل سوالات آزمون </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><span>فرم افزودن سوال جدید برای</span> <span style="color: white;font-style: italic;">{{ $azmoon->azmoon_title }}</span></li>
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
                                <h4 class="header-title"> فرم افزودن فایل سوال</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.advanced.porseshname.file.store',$azmoon) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="book_id">کتاب مربوطه</label>
                                                <select required name="book_id" id="book_id" class="form-control">
                                                    <option value="">لطفا انتخا کنید!</option>
                                                    @foreach($azmoonBooks as $soalBook)
                                                        <option value="{{ $soalBook->book->id }}">{{ $soalBook->book->book_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <label for="title">عنوان فایل </label>
                                            <div class="custom-file">
                                                <input type="text" class="form-control" id="title" name="title" placeholder="مثال : صفحه اول" value="{{ old('title') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>تصویر </label>
                                            <div class="custom-file">
                                                <input type="file" class="form-control" name="image">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>فایل pdf </label>
                                            <div class="custom-file">
                                                <input type="file" class="form-control" name="pdf_file">

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
                                            <a href="{{ route('admin.azmoons.show',$azmoon) }}"
                                               class="btn btn-info waves-effect m-l-5">
                                                برگشت به آزمون
                                            </a>
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
