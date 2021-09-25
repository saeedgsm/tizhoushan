@extends('panel.admin.master')
@section('page_title') افزودن  کادر علم برتر سالار@endsection

@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1"> کادر علم برتر سالار</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">افزودن  کادر علم برتر سالار</li>
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
                                <h4 class="header-title">افزودن  کادر علم برتر سالار</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.cadres.store') }}" method="post">
                                    @csrf
                                    <div id="user">
                                        <div class="col-lg-12 mt-5">
                                            <h4 class="form-section"><i class="mdi mdi-account"></i>اطلاعات اصلی</h4>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="first_name">نام </label>
                                                    <input id="first_name" type="text"
                                                           class="form-control @error('first_name') is-invalid @enderror"
                                                           name="first_name" value="{{ old('first_name') }}"
                                                           placeholder="نام را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="last_name">نام خانوادگی</label>
                                                    <input id="last_name" type="text"
                                                           class="form-control @error('last_name') is-invalid @enderror"
                                                           name="last_name" value="{{ old('last_name') }}"
                                                           placeholder="نام خانوادگی را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="email">ایمیل</label>
                                                    <input id="email" type="text"
                                                           class="form-control @error('email') is-invalid @enderror"
                                                           name="email" value="{{ old('email') }}"
                                                           placeholder="ایمیل را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="phone">موبایل</label>
                                                    <input id="phone" type="text"
                                                           class="form-control @error('phone') is-invalid @enderror"
                                                           name="phone" value="{{ old('phone') }}"
                                                           placeholder="موبایل را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="password" class="control-label">کلمه عبور </label>
                                                    <input type="password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           name="password"
                                                           id="password"
                                                           placeholder="کلمه عبور جدید را وارد کنید"
                                                           value="{{ old('password') }}">

                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="password-confirm" class="control-label">تکرار کلمه
                                                        عبور </label>
                                                    <input type="password"
                                                           class="form-control @error('password-confirm') is-invalid @enderror"
                                                           name="password_confirmation"
                                                           id="password-confirm"
                                                           placeholder="تکرار کلمه عبور جدید را وارد کنید"
                                                           value="{{ old('password-confirm') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">وضعیت دسترسی </h5>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="block2" name="block" value="1"
                                                           class="custom-control-input @error('block') is-invalid @enderror">
                                                    <label class="custom-control-label" for="block2">فعال</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="block3" name="block" value="0"
                                                           class="custom-control-input @error('block') is-invalid @enderror" checked="">
                                                    <label class="custom-control-label" for="block3">غیر
                                                        فعال</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="student">
                                        <div class="col-lg-12 mt-5">
                                            <h4 class="form-section"><i class="mdi mdi-account-box"></i>اطلاعات استاد</h4>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="resume">رزومه</label>
                                                    <textarea id="resume"
                                                              class="form-control @error('resume') is-invalid @enderror"
                                                              name="resume"
                                                              placeholder="رزومه را وارد کنید">{{ old('resume') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">جنسیت </h5>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="gender1" name="gender" value="unselect"
                                                           class="custom-control-input" checked>
                                                    <label class="custom-control-label" for="gender1">انتخاب
                                                        نشده</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="gender2" name="gender" value="male"
                                                           class="custom-control-input">
                                                    <label class="custom-control-label" for="gender2">مرد</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="gender3" name="gender" value="female"
                                                           class="custom-control-input">
                                                    <label class="custom-control-label" for="gender3">زن</label>
                                                </div>
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
