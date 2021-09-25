<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>تایید کد ارسالی | آکادمی تخصصی تیزهوشان علم برتر سالار</title>
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
                            <h5 class="mb-5 text-center"> تایید کد ارسالی</h5>
                            <form class="form-horizontal" method="get" action="{{ route('register.confirm.code') }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('alert_messages.alerts')
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-custom mb-4">
                                            <input type="text" class="form-control" name="scode" id="scode"  required>
                                            <label for="scode">کد تایید </label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success btn-block waves-effect waves-light" type="submit">تایید کد وارد شده!</button>
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
