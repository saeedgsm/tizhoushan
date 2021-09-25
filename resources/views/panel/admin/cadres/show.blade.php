@extends('panel.admin.master')
@section('page_title')جزئیات اطلاعات استاد@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">اطلاعات استاد</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">جزئیات اطلاعات استاد - دوره های مربوطه </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a href="{{ route('admin.teacherCourses.create',['tech_id'=>$teacher]) }}" class="btn btn-light btn-rounded dropdown-toggle"><i class="dripicons-plus mr-1"></i>
                                <b>ثبت دوره برای مربی</b>
                            </a>
                        </div>
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
                                <h4 class="header-title">جزئیات اطلاعات استاد</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <div class="row">
                                    <div class="col-md-7 col-sm-12 text-xs-center text-md-left">
                                        <p class="lead">اطلاعات استاد:</p>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <table class="table table-borderless table-sm">
                                                    <tbody>
                                                    <tr>
                                                        <td>نام نام خانوادگی:</td>

                                                        <td class="text-xs-right">{{ $teacher->first_name ?? 'ثبت نشده است' }} {{ $teacher->last_name  ?? 'ثبت نشده است' }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>شماره موبایل:</td>
                                                        <td class="text-xs-right">{{ $teacher->phone ?? 'ثبت نشده است' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ایمیل:</td>
                                                        <td class="text-xs-right">{{ $teacher->email ?? 'ثبت نشده است' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>جنسیت:</td>
                                                        <td class="text-xs-right">
                                                            @switch($teacher->teacher->gender)
                                                                @case('unselect')
                                                                    انتخاب نشده است
                                                                @break
                                                                @case('male')
                                                                    مرد
                                                                @break
                                                                @case('female')
                                                                    زن
                                                                @break
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>رزومه:</td>
                                                        <td class="text-xs-right">{{ $teacher->teacher->resume  ?? 'ثبت نشده است' }}</td>
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

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="header-title">مشاهده لیست دوره های مربوطه</h4>
                                                <p class="card-title-desc">

                                                </p>
                                                @if($courses->isNotEmpty())
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>شناسه</th>
                                                                <th>عنوان دوره</th>
                                                                <th>وضعیت دوره</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($courses as $teacher)
                                                                <tr>
                                                                    <th scope="row">{{ $teacher->course->id }}</th>
                                                                    <td>{{ $teacher->course->course_title }}</td>
                                                                    <td>{{ $teacher->course->status == 1 ? 'فعال' : 'غیر فعال'}}</td>

                                                                </tr>
                                                            @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                @else
                                                    <div class="">

                                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <strong>توجه!</strong> لیست دوره ها خالی می باشد!
                                                        </div>

                                                    </div>
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
    </div>

@endsection
