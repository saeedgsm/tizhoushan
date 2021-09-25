@extends('panel.admin.master')
@section('page_title') کاور پیش فرض@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">کاور پیش فرض</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">کاور پیش فرض قسمت های مختلف سایت</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right ">
                            <a href="{{ route('admin.defaultCovers.create') }}"
                               class="btn btn-light btn-rounded btn-sm"><i class="dripicons-plus mr-1"></i>
                                <b>افزودن کاور</b>
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
                                <h4 class="header-title">لیست کاور</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($covers->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>تصویر</th>
                                                <th>عنوان</th>
                                                <th>قسمت</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($covers as $cover)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset($cover->cover_url) }}"
                                                             class="img-fluid rounded"
                                                             width="125"
                                                             alt="cover">
                                                    </td>
                                                    <td>{{ $cover->cover_name }}</td>
                                                    <td>{{ $cover->cover_loc }}</td>
                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form
                                                                action="{{ route('admin.defaultCovers.destroy',$cover) }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-xs">

                                                                    <a href="{{ route('admin.defaultCovers.edit',$cover) }}"
                                                                       class="btn btn-warning btn-sm" title="ویرایش ">
                                                                        <i class="ti-pencil-alt"></i>
                                                                        <b>ویرایش</b>
                                                                    </a>
                                                                    @can('role-edit')
                                                                        <button
                                                                            onclick="return confirm('از حذف دسته کاور مطمئن هستید؟')"
                                                                            type="submit" class="btn btn-danger btn-sm"
                                                                            title="حذف ">
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
                                    {{ $covers->appends($_GET)->links() }}
                                @else
                                    <div class="">

                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست کاور پیش فرض خالی می باشد!
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
