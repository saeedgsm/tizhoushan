@extends('panel.student.master')
@section('page_title')نتایج تراکنش@endsection
@section('content')
    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">نتایج تراکنش</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">جزئیات پرداخت</li>
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
                                <h4 class="header-title"> وضعیت پرداخت</h4>
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
                                                    <td>نوع آزمون</td>
                                                    <td class="text-xs-right"><b>
                                                            @if($azmoon->azmoon_type == 'normal')
                                                                عادی
                                                            @else
                                                                پیشرفته
                                                            @endif
                                                        </b></td>
                                                </tr>
                                                <tr>
                                                    <td>کتاب مربوطه</td>
                                                    <td class="text-xs-right"><b>
                                                            @foreach($azmoon->azmoonBooks as $eachBook)
                                                                {{ $eachBook->book->book_name }},
                                                            @endforeach
                                                        </b></td>
                                                </tr>
                                                <tr>
                                                    <td>نام آزمون</td>
                                                    <td class="text-xs-right"><b>{{ $azmoon->azmoon_title ?? '' }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>زمان شروع</td>
                                                    <td class="text-xs-right"><b>{{ $azmoonDate['start']  }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>زمان پایان</td>
                                                    <td class="text-xs-right"><b>{{ $azmoonDate['end'] }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>مدت آزمون</td>
                                                    <td class="text-xs-right"><b>{{ $azmoon->azmoon_time ?? '' }}</b>
                                                        دقیقه
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>مبلغ قابل پرداخت برای شرکت در آزمون</td>
                                                    <td class="text-xs-right">
                                                        @if($azmoon->type_payment == 'free')
                                                            <b> رایگان</b>
                                                        @else
                                                            <b> تومان {{ $azmoon->price ?? '' }}</b>
                                                        @endif
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 text-xs-center text-md-left">
                                        <h4 class="lead">شرح پرداخت </h4>
                                        <div class="table-responsive">
                                            <table class="table ">
                                                <tbody>
                                                <tr>
                                                    <td>وضعیت آزمون</td>
                                                    <td class="text-xs-right"><b>
                                                            @if($request['Status'] == 'OK')
                                                               <span class="badge badge-success font-size-15">موفق</span>
                                                            @else
                                                                <span class="badge badge-danger font-size-15">نا موفق</span>

                                                            @endif
                                                        </b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>شماره تراکنش</td>
                                                    <td class="text-xs-right"><b>
                                                            {{ $request['Authority'] }}
                                                        </b>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
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