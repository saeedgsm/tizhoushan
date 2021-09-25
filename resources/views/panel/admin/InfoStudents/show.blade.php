@extends('panel.admin.master')
@section('page_title')جزئیات اطلاعات دانش آموز@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">اطلاعات دانش آموز</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">جزئیات اطلاعات دانش آموز - پایه آموزشی و کلاس های آموزشی مربوطه </li>
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
                                <h4 class="header-title">جزئیات اطلاعات دانش آموز</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <div class="row">
                                    <div class="col-md-7 col-sm-12 text-xs-center text-md-left">
                                        <p class="lead">اطلاعات دانش آموز:</p>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <table class="table table-borderless table-sm">
                                                    <tbody>
                                                    <tr>
                                                        <td>نام نام خانوادگی:</td>

                                                        <td class="text-xs-right">{{ $student->first_name ?? 'ثبت نشده است' }} {{ $student->last_name  ?? 'ثبت نشده است' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>کد ملی:</td>
                                                        <td class="text-xs-right">{{ $student->student->melli ?? 'ثبت نشده است' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>نام پدر:</td>
                                                        <td class="text-xs-right">{{ $student->student->father  ?? 'ثبت نشده است' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>شماره موبایل:</td>
                                                        <td class="text-xs-right">{{ $student->phone ?? 'ثبت نشده است' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ایمیل:</td>
                                                        <td class="text-xs-right">{{ $student->email ?? 'ثبت نشده است' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>جنسیت:</td>
                                                        <td class="text-xs-right">
                                                            @switch($student->student->gender)
                                                                @case('unselect')
                                                                    انتخاب نشده است
                                                                @break
                                                                @case('male')
                                                                    پسر
                                                                @break
                                                                @case('female')
                                                                    دختر
                                                                @break
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>استان - شهر:</td>
                                                        <td class="text-xs-right">{{ $state ?? 'ثبت نشده است' }} - {{ $city ?? 'ثبت نشده است' }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-12">
                                        <p class="lead">کل پرداختی</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td>جمع کل</td>
                                                    <td class="text-xs-right">0 ريال</td>
                                                </tr>
                                                <tr>
                                                    <td>تخفیف (12%)</td>
                                                    <td class="text-xs-right">0 ريال</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800">کل</td>
                                                    <td class="text-bold-800 text-xs-right"> 0 ريال</td>
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
