<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ورود | آکادمی تخصصی تیزهوشان علم برتر سالار</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-mini.png') }}">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vazir/font-face.css') }}" rel="stylesheet" type="text/css" />
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
                            <h5 class="mb-5 text-center">صفحه ورود به پنل کاربری</h5>
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('alert_messages.alerts')
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-custom mb-4">
                                            <input type="text" class="form-control" name="inId" id="inId" required>
                                            <label for="inId">کد کاربری</label>
                                        </div>

                                        <div class="form-group form-group-custom mb-4">
                                            <input type="password" class="form-control" name="password" id="userpassword" required>
                                            <label for="userpassword">کلمه عبور</label>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customControlInline" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="customControlInline">مرا به خاطر بسپار</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-md-right mt-3 mt-md-0" style="font-size: small;">
                                                    @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i> کلمه عبور را فراموش کرده ام؟</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-success btn-block waves-effect waves-light" type="submit">ورود</button>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <a href="{{ route('register') }}" class="text-muted"><i class="mdi mdi-account-circle mr-1"></i> ایجاد حساب کاربری جدید</a>
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
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>

<script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

<script src="/assets/js/app.js"></script>

</body>
</html>
