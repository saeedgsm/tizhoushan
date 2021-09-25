@extends('panel.admin.master')
@section('page_title')جزئیات پایه آموزشی@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">پایه های آموزشی</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">جزئیات پایه آموزشی و کلاس های آموزشی مربوطه </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a href="{{ route('admin.classes.create') }}" class="btn btn-light btn-rounded dropdown-toggle"><i class="dripicons-plus mr-1"></i>
                                <b>افزودن کلاس آموزشی</b>
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
                                <h4 class="header-title">مشاهده جزئیات پایه آموزشی</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>

                                <form action="#" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="base_title">عنوان پایه</label>
                                            <input type="text" disabled
                                                   class="form-control"
                                                   name="base_title"
                                                   value="{{ old('base_title',$basis->base_title) }}"
                                                   id="base_title" placeholder="عنوان پایه را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان پایه را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="base_label">لیبل پایه</label>
                                            <input type="text" disabled
                                                   class="form-control"
                                                   name="base_label"
                                                   value="{{ old('base_label',$basis->base_label) }}"
                                                   id="base_label" placeholder="لیبل پایه را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">لیبل پایه را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">مشاهده لیست کلاس های آموزشی </h4>
                                <p class="card-title-desc">

                                </p>
                                @if($classes->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>شناسه</th>
                                                <th>عنوان کلاس</th>
                                                <th>لیبل</th>
                                                <th>پایه آموزشی</th>
                                                <th>قابل ثبت نام</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($classes as $class)
                                                <tr>
                                                    <th scope="row">{{ $class->id }}</th>
                                                    <td>{{ $class->class_title }}</td>
                                                    <td>{{ $class->class_label }}</td>
                                                    <td>{{ $class->educationBase->base_title }}</td>
                                                    <td>
                                                        @if($class->registrable == 1)
                                                            <a href="{{ route('admin.class.registrable',$class->id) }}"
                                                               class="btn btn-success text-white btn-sm">  فعال </a>
                                                        @else
                                                            <a href="{{ route('admin.class.registrable',$class->id) }}"
                                                               class="btn btn-danger text-white btn-sm">  غیر فعال </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="{{ route('admin.classes.destroy',$class) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-xs">
                                                                    <a href="{{ route('admin.classes.show',$class) }}" class="btn btn-info" title="مشاهده جزئیات کلاس آموزشی ">
                                                                        <i class="ti-eye"></i>
                                                                        <b>جزئیات</b>
                                                                    </a>
                                                                    <a href="{{ route('admin.classes.edit',$class) }}" class="btn btn-warning" title="ویرایش ">
                                                                        <i class="ti-pencil-alt"></i>
                                                                        <b>ویرایش</b>
                                                                    </a>
                                                                    <button onclick="return confirm('از حذف کلاس مطمئن هستید؟')" type="submit" class="btn btn-danger" title="حذف ">
                                                                        <i class="ti-trash"></i>
                                                                        <b>حذف</b>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </td>
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
                                            <strong>توجه!</strong> لیست کلاس ها خالی می باشد!
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
