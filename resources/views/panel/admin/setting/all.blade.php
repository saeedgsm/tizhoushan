@extends('panel.admin.master')

@section('page_title')تنظیمات سایت @endsection

@section('content')
    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">تنظیمات سایت</h4>
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
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <div class="text-center mt-4">
                                            <h4>تنظیمات سایت</h4>
                                            <p class="text-muted">مدیریت محترم در این صفحه سایت می توانید قسمت های تعریف شده را تغییر دهید!</p>
                                        </div>

                                        <div class="row mt-5">
                                            <div class="col-lg-4">
                                                <div class="card border shadow-none">
                                                    <div class="card-body">
                                                        <div class="media">
                                                            <div class="icons-md mr-3">
                                                                <i class="fa fa-sms font-size-24" style="color: #3051d3;"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <h5 class="mb-1">پیامک ثبت نام</h5>
                                                                <p class="text-muted">مدیریت پیامک ثبت نام دانش آموز</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-center">
                                                    @if($sms->status == 1)

                                                            <a href="{{ route('admin.setting.sms') }}" class="btn btn-success btn-sm">فعال</a>

                                                    @else

                                                            <a href="{{ route('admin.setting.sms') }}" class="btn btn-danger btn-sm">غیر فعال</a>

                                                    @endif
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
                <!-- end row -->

            </div>
            <!-- end container-fluid -->
        </div>
    </div>
@endsection
