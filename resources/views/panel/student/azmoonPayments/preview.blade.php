@extends('panel.student.master')
@section('page_title')تایید پرداخت@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">تایید اطلاعات پرداخت</h4>
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
                                <h4 class="header-title"> جزئیات آزمون</h4>
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
                                        <form action="{{ route('student.azmoon.payment.request') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="azmoon_id" value="{{ $azmoon->id }}">
                                            <input type="hidden" name="amount" value="{{ $azmoon->price }}">
                                            <div class="col-12">
                                                <h3>قوانین</h3>
                                                <p style="
                                                padding: 12px;
                                                border: 2px solid dodgerblue;
                                                 border-radius: 5px;
                                                 background-color: #93a5e8; color: #FFFFFF">کاربران اپلیکیشن‌های مختلف ترجیح می‌دهند که به جای ایجاد اکانت برای هر اپلیکیشن، از اکانت خود در اپلیکیشن‌های شناخته شده، بدون نیاز به وارد کردن اطلاعات جدید و تنها با چند کلیک استفاده کنند. Sociallite یکی از محبوب‌ترین پکیج‌های لاراول است که به منظور احراز هویت به وسیله‌ی شبکه‌های اجتماعی مثل فیس بوک، توییتر، گیت هاب، گوگل و چند مورد دیگر استفاده می‌شود. با استفاده از دستور زیر می‌توانید این پکیج را در اپلیکیشن خود نصب کنید:

                                                </p>
                                            </div>

                                           <div class="col-12">
                                               <div class="mt-4">
                                                   <h5 class="font-size-14 mb-3">درگاهی پرداختی</h5>
                                                   <div class="custom-control custom-radio custom-control-inline">
                                                       <input type="radio" id="gateway1" name="gateway" class="custom-control-input" value="zarin" checked="">
                                                       <label class="custom-control-label" for="gateway1">زرین پال</label>
                                                   </div>
                                                   <div class="custom-control custom-radio custom-control-inline">
                                                       <input type="radio" id="gateway2" name="gateway" value="pay" class="custom-control-input" >
                                                       <label class="custom-control-label" for="gateway2">پی پرداخت</label>
                                                   </div>
                                               </div>
                                           </div>
                                            <div class="col-12">
                                                <div class="m-5">
                                                    <button type="submit" class="btn btn-success btn-block"> پرداخت</button>
                                                </div>
                                            </div>
                                        </form>
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