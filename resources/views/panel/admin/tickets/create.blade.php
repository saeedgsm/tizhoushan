@extends('panel.admin.master')
@section('page_title')ایجاد تیکت@endsection
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-dropdown {
            top: 22px !important;
            left: 8px !important;
        }
    </style>
@endsection
@section('script')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#user").select2({
            placeholder: "انتخاب کاربر",
            allowClear: true
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
                        <h4 class="page-title mb-1">ایجاد تیکت </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم ایجاد تیکت جدید</li>
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
                                <h4 class="header-title"> فرم ایجاد تیکت جدید</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.tickets.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-group">
                                                <label for="user">کاربر مورد نظر</label>
                                                <select autofocus
                                                        class="form-control"
                                                        name="user_id" id="user" data-live-search="true">
                                                    <option value="">لطفا انتخاب کنید!</option>
                                                    @foreach($users as $user)
                                                        <option
                                                            value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}
                                                            - {{ $user->usercode }} - {{ $user->phone }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-group">
                                                <label for="category">دسته بندی تیکت</label>
                                                <select autofocus
                                                        class="form-control"
                                                        name="category_id" id="category">
                                                    <option value="">لطفا انتخاب کنید!</option>
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{ $category->id }}">{{ $category->ticket_category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="title">عنوان تیکت</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="title"
                                                   value="{{ old('title') }}"
                                                   id="title"
                                                   placeholder="عنوان تیکت را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان تیکت را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-group">
                                                <label for="priority">اولویت</label>
                                                <select autofocus
                                                        class="form-control"
                                                        name="priority" id="priority">
                                                    <option value="">لطفا انتخاب کنید!</option>
                                                    <option value="low">پایین</option>
                                                    <option value="medium">متوسط</option>
                                                    <option value="high">بالا</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="message">پیام</label>
                                            <textarea type="text"
                                                   class="form-control"
                                                   name="message"
                                                      rows="4"
                                                   id="message"
                                                      placeholder="پیام را وارد کنید">{{ old('message') }}</textarea>
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان دسته بندی تیکت را وارد کنید</li>
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
