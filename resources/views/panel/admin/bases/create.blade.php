@extends('panel.admin.master')
@section('page_title')افزودن پایه آموزشی@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">پایه های آموزشی </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم افزودن پایه جدید</li>
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
                                <h4 class="header-title"> فرم افزودن پایه</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.bases.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="base_title">عنوان پایه</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="base_title"
                                                   value="{{ old('base_title') }}"
                                                   id="base_title" placeholder="عنوان پایه را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان پایه را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="base_label">لیبل پایه</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="base_label"
                                                   value="{{ old('base_label') }}"
                                                   id="base_label" placeholder="لیبل پایه را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">لیبل پایه را وارد کنید</li>
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
