<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>ثبت نام | آکادمی تخصصی تیزهوشان علم برتر سالار</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesdesign" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-mini.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Icons Css -->
    <link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{ asset('/assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vazir/font-face.css') }}" rel="stylesheet" type="text/css"/>
</head>

<body class="bg-primary bg-pattern" style="font-family: Vazir">
<div class="home-btn d-none d-sm-block">
    <a href="/"><i class="mdi mdi-home-variant h2 text-white"></i></a>
</div>

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5">
                    <a href="/" class="logo"><img src="{{ asset('imgs/logo-panel.png') }}" height="100" alt="logo"><br></a>
                    <br>
                    <h5 class="font-size-18 text-white-50 mb-4">آکادمی تخصصی تیزهوشان علم برتر سالار</h5>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-xl-5 col-sm-8">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="p-2">
                            <h5 class="mb-5 text-center">صفحه ثبت نام</h5>
                            <form class="form-horizontal" method="POST" action="">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('alert_messages.alerts')
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-custom mb-4">
                                            <input type="text"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   name="first_name" id="first_name" value="{{ old('first_name') }}" autocomplete="off">
                                            <label for="first_name"><span>نام</span></label>
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-group-custom mb-4">
                                            <input type="text"
                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                   name="last_name" id="last_name" value="{{ old('last_name') }}" autocomplete="off">
                                            <label for="last_name"><span>نام خانوادگی</span></label>
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-group-custom mb-4">
                                            <input type="text"
                                                   class="form-control @error('usercode') is-invalid @enderror"
                                                   name="usercode" id="usercode" value="{{ old('usercode') }}" autocomplete="off">
                                            <label for="usercode"><span>کد کاربری</span> <span
                                                    class="text-danger">*</span></label>
                                            @error('usercode')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-group-custom mb-4">
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                   name="phone" id="phone" value="{{ old('phone') }}" autocomplete="off">
                                            <label for="phone"><span>شماره موبایل</span> <span
                                                    class="text-danger">*</span></label>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group form-group-custom mb-4">
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                   name="email" id="email" value="{{ old('email') }}" autocomplete="off">
                                            <label for="email">آدرس ایمیل</label>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <div class="form-group form-group-custom mb-4">
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" id="userpassword" autocomplete="new-password">
                                            <label for="userpassword"><span>کلمه عبور</span> <span class="text-danger">*</span></label>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <div class="form-group form-group-custom mb-4">
                                            <input type="password"
                                                   class="form-control @error('password-confirm') is-invalid @enderror"
                                                   name="password_confirmation" id="password-confirm" autocomplete="new-password">
                                            <label for="password-confirm"><span>تکرار کلمه عبور</span> <span class="text-danger">*</span></label>
                                            @error('password-confirm')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success btn-block waves-effect waves-light"
                                                    type="submit">ایجاد حساب کاربری
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
<!-- end Account pages -->

<!-- JAVASCRIPT -->
<script src="{{ asset('/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('/assets/libs/node-waves/waves.min.js') }}"></script>

<script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

<script src="{{ asset('/assets/js/app.js') }}"></script>

</body>
</html>
