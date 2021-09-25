@extends('panel.agency.master')
@section('page_title') داشبرد@endsection
@section('content')
    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">داشبرد نمایندگی</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">به پنل نمایندگی خوش آمدید</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="media">
                                        <div class="media-body text-xs-left">
                                            <h3 class="pink">{{ $studentCount - 1 }}</h3>
                                            <span>کل دانش آموزان </span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="uil uil-users-alt icons-large"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="media">
                                        <div class="media-body text-xs-left">
                                            <h3 class="pink">0</h3>
                                            <span>تعداد دانش آموزان آنلاین</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="uil uil-users-alt icons-large"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="media">
                                        <div class="media-body text-xs-left">
                                            <h3 class="teal">0</h3>
                                            <span>نفرات برتر </span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="uil uil-credit-card icons-large"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-block">
                                    <div class="media">
                                        <div class="media-body text-xs-left">
                                            <h3 class="deep-orange">0</h3>
                                            <span>کلاس های آنلاین</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="uil uil-invoice icons-large"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
