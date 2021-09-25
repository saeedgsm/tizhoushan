@extends('panel.admin.master')
@section('page_title') دانش آموزان@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">دانش آموزان</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست پروفایل های تایید نشده دانش آموزان</li>
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
                                <h4 class="header-title">لیست دانش آموزان</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($unchecked->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>تصویر پروفایل</th>
                                                <th>نام و نام خانوادگی</th>
                                                <th>پایه</th>
                                                <th>کلاس</th>
                                                <th>کد کاربری</th>
                                                <th>رمز کاربری</th>
                                                <th>اطلاعات تماس</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($unchecked as $student)
                                                <tr>
                                                    <td><img src="{{ asset($student->avatar) }}" width="128" alt="profile"></td>
                                                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                                    <td>{{ $student->studentBaseClass->educationBase->base_title ?? 'نامشخص' }}</td>
                                                    <td>{{ $student->studentBaseClass->educationClass->class_title ?? 'نامشخص' }}</td>
                                                    <td>{{ $student->usercode }}</td>
                                                    <td>{{ $student->userpass }}</td>
                                                    <td>
                                                        ایمیل: {{ $student->email ?? 'نامشخص' }}
                                                        <br>
                                                        موبایل: {{ $student->phone ?? 'نامشخص' }}

                                                    </td>

                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="{{ route('admin.students.destroy',$student) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-xs">
                                                                    <a href="{{ route('admin.student.profile.submit',$student) }}" class="btn btn-warning" title="ویرایش ">
                                                                        <i class="ti-pencil-alt"></i>
                                                                        <b>تایید تصویر</b>
                                                                    </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $unchecked->appends($_GET)->links() }}
                                @else
                                    <div class="">

                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست دانش آموزان خالی می باشد!
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

@endsection
