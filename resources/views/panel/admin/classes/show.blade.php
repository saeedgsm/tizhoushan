@extends('panel.admin.master')
@section('page_title')جزئیات کلاس آموزشی@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">کلاس های آموزشی</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">کلاس آموزشی و لیست دانش آموزان</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a href="{{ route('admin.classStudents.create',['class'=>$class]) }}" class="btn btn-light btn-rounded dropdown-toggle"><i class="dripicons-plus mr-1"></i>
                                <b>ثبت نام دانش آموز در کلاس</b>
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
                                <h4 class="header-title">جزئیات کلاس آموزشی</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="#" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">

                                        <div class="col-md-4 mb-3">
                                            <label for="class_title">پایه آموزشی </label>
                                            <input type="text" disabled
                                                   class="form-control"
                                                   name="class_title"
                                                   value="{{ old('class_title',$class->educationBase->base_title) }}"
                                                   id="class_title" placeholder="عنوان کلاس را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">پایه آموزشی را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="class_title">عنوان کلاس</label>
                                            <input type="text" disabled
                                                   class="form-control"
                                                   name="class_title"
                                                   value="{{ old('class_title',$class->class_title) }}"
                                                   id="class_title" placeholder="عنوان کلاس را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان کلاس را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="class_label">لیبل کلاس</label>
                                            <input type="text" disabled
                                                   class="form-control"
                                                   name="class_label"
                                                   value="{{ old('class_label',$class->class_label) }}"
                                                   id="class_label" placeholder="لیبل کلاس را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">لیبل کلاس را وارد کنید</li>
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
                                <h4 class="header-title">لیست دانش آموزان کلاس</h4>
                                <p class="card-title-desc">

                                </p>
                                @if($students->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>شناسه</th>
                                                <th>دانش آموز</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($students as $student)
                                                <tr>
                                                    <th scope="row">{{ $student->id }}</th>
                                                    <td>{{ $student->student->first_name }} {{ $student->student->last_name }}</td>
                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="#" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-xs">
                                                                    <a href="{{ route('admin.students.show',$student->student) }}" class="btn btn-info" title="مشاهده جزئیات دانش آموز ">
                                                                        <i class="ti-eye"></i>
                                                                        <b>جزئیات دانش آموز</b>
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
