
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-mini.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/agency.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('vazir/font-face.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css" />


    @yield('style')

</head>

<body data-topbar="colored" data-layout="horizontal" data-layout-size="boxed">
    <div id="layout-wrapper">
        @include('panel.agency.section.header')
<div class="main-content">
@yield('content')
@include('panel.agency.section.footer')
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
    @yield('script')
    <script src="{{ asset('assets/js/app.js') }}"></script>


</body>
</html>
