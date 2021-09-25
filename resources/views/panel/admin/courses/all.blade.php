@extends('panel.admin.master')
@section('page_title')لیست  دوره ها@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">دوره ها</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست دوره ها</li>
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
                                <h4 class="header-title">لیست دوره ها</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($courses->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>شناسه</th>
                                                <th>عنوان دوره</th>
                                                <th>کلاس</th>
                                                <th>وضعیت</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($courses as $course)
                                                <tr>
                                                    <th scope="row">{{ $course->id }}</th>
                                                    <td>{{ $course->course_title }}</td>
                                                    <td>

                                                    </td>
                                                    <td>
                                                        @if($course->status == 1)
                                                            <a href="{{ route('admin.course.change.status',$course) }}" class="btn btn-success btn-sm" title="فعال">
                                                                <i class="glyphicon glyphicon-ok"></i>
                                                                فعال
                                                            </a>
                                                        @else
                                                            <a href="{{ route('admin.course.change.status',$course) }}" class="btn btn-danger btn-sm" title="غیرفعال">
                                                                <i class="glyphicon glyphicon-"></i>
                                                                غیرفعال
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="{{ route('admin.courses.destroy',$course) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-sm">
                                                                    <a href="{{ route('admin.courses.edit',$course) }}" class="btn btn-warning" title="ویرایش ">
                                                                        <i class="ti-pencil-alt"></i>
                                                                        <b>ویرایش</b>
                                                                    </a>
                                                                    @can('role-edit')
                                                                    <button onclick="return confirm('از حذف دوره مطمئن هستید؟')" type="submit" class="btn btn-danger" title="حذف ">
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
                                    {{ $courses->appends($_GET)->links() }}
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

@endsection
