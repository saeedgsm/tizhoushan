@extends('panel.admin.master')
@section('page_title') اساتید@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">اساتید</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست اساتید</li>
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
                                <h4 class="header-title">لیست اساتید</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($teachers->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>شناسه</th>
                                                <th>نام و نام خانوادگی</th>
                                                <th>اطلاعات تماس</th>
                                                <th>دوره های مربوطه</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($teachers as $teacher)
                                                <tr>
                                                    <th scope="row">{{ $teacher->id }}</th>
                                                    <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                                                    <td>
                                                        ایمیل: {{ $teacher->email }}
                                                        <br>
                                                        موبایل: {{ $teacher->phone }}

                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.teachers.show',$teacher) }}" class="btn btn-info" title="مشاهده جزئیات استاد و دوره های مربوطه ">
                                                            <i class="ti-eye"></i>
                                                            <b>جزئیات استاد</b>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="{{ route('admin.teachers.destroy',$teacher) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-xs">
                                                                    <a href="{{ route('admin.teachers.edit',$teacher) }}" class="btn btn-warning" title="ویرایش ">
                                                                        <i class="ti-pencil-alt"></i>
                                                                        <b>ویرایش</b>
                                                                    </a>
                                                                    @can('role-edit')
                                                                    <button onclick="return confirm('از حذف دانش آموز مطمئن هستید؟')" type="submit" class="btn btn-danger" title="حذف ">
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
                                    {{ $teachers->appends($_GET)->links() }}
                                @else
                                    <div class="">

                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست اساتید خالی می باشد!
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
