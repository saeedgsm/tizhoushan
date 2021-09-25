@extends('panel.admin.master')
@section('page_title') فیلد های فیلد های ثابت@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">فیلد های ثابت</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">تغییر وضعیت لیست فیلد ها برای کاربران</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right d-md-block ">
                            <a href="{{ route('admin.fields.create') }}" disabled
                               class="btn btn-light btn-rounded d-none"><i class="dripicons-plus mr-1"></i>
                                <b>افزودن قسمت جدید</b>
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
                                <h4 class="header-title">لیست فیلد های سفارشی</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>

                                @if($fields->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>نام قسمت </th>
                                                <th>فیلد های سفارش شده</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($fields as $field)
                                                <tr>
                                                    <td>{{ $field->custom_field_name }}</td>
                                                    <td>{{ $field->field_list[0] }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.fields.edit',$field) }}" class="btn btn-warning" title="ویرایش ">
                                                            <i class="ti-pencil-alt"></i>
                                                            <b>ویرایش</b>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $fields->appends($_GET)->links() }}
                                @else
                                    <div class="">

                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست دسته بندی تیکت خالی می باشد!
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
