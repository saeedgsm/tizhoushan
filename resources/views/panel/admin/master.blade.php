
<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>پنل مدیریت</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="علم برتر سالار" name="description" />
    <meta content="آزمون" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-mini.png') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('style')
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('vazir/font-face.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/css/animate.min.css') }}"/>
    <link rel="stylesheet" type="text/css"  href="{{ asset('assets/js/ionicons.min.js') }}"/>
</head>

<body data-topbar="colored">
    <div id="app">

        <div id="layout-wrapper">
            @include('panel.admin.section.header')
            @include('panel.admin.section.verticalMenu')
            <div class="main-content">
                <router-view></router-view>
                    @yield('content')
                <my-footer></my-footer>
            </div>
        </div>
    </div>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/js/bundle.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('js/v0.1.122/vue.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @yield('script')

</body>
</html>
