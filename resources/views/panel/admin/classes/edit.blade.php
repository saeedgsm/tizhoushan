@extends('panel.admin.master')
@section('page_title')ویرایش کلاس@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">کلاس ها</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم ویرایش کلاس </li>
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
                                <h4 class="header-title"> فرم ویرایش کلاس</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.classes.update',$class) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-group">
                                                <label for="base">پایه آموزشی </label>
                                                <select autofocus
                                                        class="form-control  @error('base_id') is-invalid @enderror"
                                                        name="base_id" id="base">
                                                    <option value="">لطفا انتخاب کنید!</option>
                                                    @foreach($bases as $base)
                                                        <option value="{{ $base->id }}" {{ $base->id == $class->base_id ? 'selected' : '' }}>{{ $base->base_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="class_title">عنوان کلاس</label>
                                            <input type="text"
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
                                            <input type="text"
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
                                    <div class="col-lg-12">
                                        <div class="form-group mt-4">
                                            <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">
                                                ثبت اطلاعات
                                            </button>
                                            <button type="reset"
                                                    class="btn btn-secondary waves-effect m-l-5">
                                                تازه سازی فرم
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
