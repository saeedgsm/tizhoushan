@extends('panel.teacher.master')

@section('page_title') فرم ویرایش اطلاعات @endsection

@section('content')

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ویرایش اطلاعات</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">فرم ویرایش اطلاعات</h4>
                                <p class="card-title-desc"></p>
                                <div class="">
                                    <hr>
                                </div>
                                <div class="p-3">
                                    @include('alert_messages.alerts')
                                    <div class="col-lg-12">
                                        <form action="{{ route('admin.panel.update') }}" method="post"
                                              class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label">نام
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" name="first_name"
                                                               id="name"
                                                               placeholder="اسم کوچک را وارد کنید" autofocus
                                                               value="{{ old('first_name',$user->first_name) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="last_name" class="control-label">نام خانوادگی
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" name="last_name"
                                                               id="last_name"
                                                               placeholder="نام خانوادگی را وارد کنید"
                                                               value="{{ old('last_name',$user->last_name) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="email" class="control-label">ایمیل فعلی
                                                            : {{ $user->email }} </label>
                                                        <input type="email" class="form-control" name="email"
                                                               id="email"
                                                               placeholder="ایمیل جدید را وارد کنید"
                                                               value="{{ old('email') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="phone" class="control-label">تلفن همراه فعلی
                                                            : {{ $user->phone }} </label>
                                                        <input type="number" class="form-control" name="phone"
                                                               id="phone"
                                                               placeholder="شماره جدید موبایل را وارد کنید"
                                                               value="{{ old('phone') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="password" class="control-label">کلمه عبور </label>
                                                        <input type="password" class="form-control" name="password"
                                                               id="password"
                                                               placeholder="کلمه عبور جدید را وارد کنید"
                                                               value="{{ old('password') }}">

                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="password-confirm" class="control-label">تکرار کلمه
                                                            عبور </label>
                                                        <input type="password" class="form-control"
                                                               name="password_confirmation"
                                                               id="password-confirm"
                                                               placeholder="تکرار کلمه عبور جدید را وارد کنید"
                                                               value="{{ old('password-confirm') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label>عکس پروفایل</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="avatar"
                                                               id="validationCustomFile">
                                                        <label class="custom-file-label" for="validationCustomFile">انتخاب
                                                            عکس پروفایل...</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">
                                                        ثبت اطلاعات
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                        تازه سازی فرم
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
    <!-- End Page-content -->

@endsection
