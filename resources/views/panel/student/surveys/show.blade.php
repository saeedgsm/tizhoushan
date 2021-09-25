@extends('panel.student.master')
@section('page_title') نظرسنجی ها@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">نظرسنجی ها</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست نظرسنجی</li>
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
                                <h4 class="header-title">مشاهده جزئیات نظرسنجی</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>

                                <div class="row">
                                    <div class="col-sm-4 text-xs-center text-md-left">
                                        <h4 class="lead">جزئیات </h4>
                                        <div class="table-responsive">
                                            <table class="table ">
                                                <tbody>
                                                <tr>
                                                    <td>نوع نظرسنجی</td>
                                                    <td class="text-xs-right"> <b>
                                                            @if($survey->azmoon_type == 'normal')
                                                                عادی
                                                            @else
                                                                پیشرفته
                                                            @endif
                                                        </b></td>
                                                </tr>

                                                <tr>
                                                    <td>نام نظرسنجی</td>
                                                    <td class="text-xs-right"><b>{{ $survey->azmoon_title ?? '' }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>زمان شروع</td>
                                                    <td class="text-xs-right"><b>{{ $azmoonDate['start']  }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>زمان پایان</td>
                                                    <td class="text-xs-right"><b>{{ $azmoonDate['end'] }}</b></td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 text-xs-center text-md-left">
                                        <h4 class="lead">جزئیات </h4>
                                        <div class="table-responsive">
                                            <table class="table ">
                                                <tbody>
                                                <tr>
                                                    <td>مدت نظرسنجی</td>
                                                    <td class="text-xs-right"><b>{{ $survey->azmoon_time ?? '' }}</b>
                                                        دقیقه
                                                    </td>
                                                </tr>

                                                </tbody>

                                            </table>
                                            @if(! $checkAzmoon)
                                        <div class="text-xs-center p-5">
                                            <a href="{{ route('student.surveys.start',$survey) }}" class="btn btn-outline-info  btn-block">شروع نظرسنجی </a>
                                        </div>
                                        @else
                                            <div class="text-xs-center p-5">
                                                <a href="{{ route('student.surveys.result',$survey) }}" class="btn btn-outline-success btn-block" >مشاهده نتایج</a>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div>
                                            <h5 class="font-size-14">کاور نظرسنجی</h5>
                                            <a class="image-popup-vertical-fit" href="{{ asset($soal->soal_cover) }}" title="Caption. Can be aligned it to any side and contain any HTML.">
                                                <img class="img-fluid" alt=""
                                                @if (file_exists($soal->soal_cover))
                                                    src="{{ asset($soal->soal_cover) }}"
                                                @else
                                                src="{{ asset('imgs/wall.jpg') }}"
                                                @endif

                                                 width="400">
                                            </a>
                                            <div class="alert alert-info alert-dismissible fade show m-1" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <span><strong> توجه! </strong>بعد شروع نظرسنجی به هیچ عنوان صفحه را رفرش با دوباره بارگزاری نکنید!
                                                <span><strong> </strong>چون باعث انصراف از نظرسنجی می شود!

                                                </span>

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
    </div>

@endsection
