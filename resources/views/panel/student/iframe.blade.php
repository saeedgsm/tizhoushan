@extends('panel.student.master')
@section('page_title')@endsection
@section('style')
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" > <meta name="mobile-web-app-capable" content="yes">
@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">داشبرد دانش آموز</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">به پنل دانش آموز خوش آمدید</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="page-content-wrapper">
            <div class="container-fluid">
                

                <div class="row" style="height: 400px">
                    <iframe src="https://www.skyroom.online/ch/my-room-url" width="100%" height="100%" frameborder="0" allowFullScreen="true" allow="autoplay;fullscreen;speaker;microphone;camera;display-capture"></iframe>
                </div>
            </div>
        </div>
    </div>

@endsection
