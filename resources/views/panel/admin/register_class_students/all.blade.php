@extends('panel.admin.master')
@section('page_title')دانش آموزان ثبت نام@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">دانش آموزان ثبت نام</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست دانش آموزان ثبت نام</li>
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
                                <h4 class="header-title">لیست دانش آموزان ثبت نام</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($registers->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>شناسه</th>
                                                <th>کلاس آموزشی</th>
                                                <th>دانش آموز</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($registers as $reg)
                                                <tr>
                                                    <th scope="row">{{ $reg->id }}</th>
                                                    <td>{{ $reg->educationClass->class_title }}</td>
                                                    <td>{{ $reg->student->first_name }} {{ $reg->student->last_name }}</td>
                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="{{ route('admin.classStudents.destroy',$reg) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-xs">
                                                                    <a href="{{ route('admin.classStudents.edit',$reg) }}" class="btn btn-warning" title="ویرایش ">
                                                                        <i class="ti-pencil-alt"></i>
                                                                        <b>ویرایش</b>
                                                                    </a>
                                                                    @can('role-edit')
                                                                    <button onclick="return confirm('از حذف ثبت نامی مطمئن هستید؟')" type="submit" class="btn btn-danger" title="حذف ">
                                                                        <i class="ti-trash"></i>
                                                                        <b>حذف</b>
                                                                    </button>
                                                                    @endcan
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $registers->appends($_GET)->links() }}
                                @else
                                    <div class="">
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست ثبت نام خالی می باشد!
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
