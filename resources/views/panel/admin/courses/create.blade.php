@extends('panel.admin.master')
@section('page_title')افزودن دوره@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">دوره ها</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم افزودن دوره جدید</li>
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
                                <h4 class="header-title"> فرم افزودن دوره</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.courses.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="course_title">عنوان دوره</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="course_title"
                                                   value="{{ old('course_title') }}"
                                                   id="course_title" placeholder="عنوان دوره را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان دوره را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-lg-3">
                                            <h5 class="font-size-14">وضعیت </h5>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="status2" name="status" value="1"
                                                       class="custom-control-input">
                                                <label class="custom-control-label" for="status2">فعال</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="status3" name="status" value="0"
                                                       class="custom-control-input" checked="">
                                                <label class="custom-control-label" for="status3">غیر
                                                    فعال</label>
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
