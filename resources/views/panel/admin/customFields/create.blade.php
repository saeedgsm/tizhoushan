@extends('panel.admin.master')
@section('page_title') فیلد های سفارشی@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">فیلد های سفارشی</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">سفارش سازی لیست فیلد ها برای کاربران</li>
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
                                <h4 class="header-title">لیست فیلد های سفارشی</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.fields.store') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="custom_field_name"></label>
                                                <input type="text" required
                                                       class="form-control"
                                                       name="custom_field_name"
                                                       value="{{ old('custom_field_name') }}"
                                                       id="custom_field_name" placeholder="عنوان را وارد کنید">
                                                @error('error')
                                                <ul class="parsley-errors-list is-invalid"
                                                    id="parsley-id-5" aria-hidden="false">
                                                    <li class="parsley-required">عنوان را وارد کنید</li>
                                                </ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="table_task"></label>
                                                <input type="text" required
                                                       class="form-control"
                                                       name="table_task" dir="ltr" i
                                                       value="{{ old('table_task') }}"
                                                       id="table_task" placeholder="مسیر وظیفه را وارد کنید">
                                                @error('error')
                                                <ul class="parsley-errors-list is-invalid"
                                                    id="parsley-id-5" aria-hidden="false">
                                                    <li class="parsley-required">عنوان را وارد کنید</li>
                                                </ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label for="field_list"></label>
                                                <textarea type="text" required
                                                          rows="5" dir="ltr"
                                                          class="form-control"
                                                          name="field_list"
                                                          placeholder="لیست فیلد را وارد کنید"
                                                          id="field_list">{{ old('field_list') }}</textarea>
                                                @error('error')
                                                <ul class="parsley-errors-list is-invalid"
                                                    id="parsley-id-5" aria-hidden="false">
                                                    <li class="parsley-required">عنوان را وارد کنید</li>
                                                </ul>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">
                                            ثبت اطلاعات
                                        </button>
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
