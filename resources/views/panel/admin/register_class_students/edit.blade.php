@extends('panel.admin.master')
@section('page_title')ویرایش دانش آموز در کلاس های آموزشی@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">دانش آموز در کلاس های آموزشی</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">ویرایش دانش آموز در کلاس های آموزشی</li>
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
                                <h4 class="header-title"> فرم ویرایش دانش آموز در کلاس های آموزشی</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.classStudents.update',$classStudent) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="user">دانش آموزان </label>
                                                <select autofocus
                                                        class="form-control  @error('user_id') is-invalid @enderror"
                                                        name="user_id" id="user">
                                                    <option value="">لطفا انتخاب کنید!</option>
                                                    @foreach($students as $student)
                                                        <option
                                                            value="{{ $student->id }}" {{ $student->id == $classStudent->user_id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="class">کلاس های آموزشی </label>
                                                <select autofocus
                                                        class="form-control  @error('class_id') is-invalid @enderror"
                                                        name="class_id" id="class">
                                                    <option value="">لطفا انتخاب کنید!</option>
                                                    @foreach($classes as $class)
                                                        <option value="{{ $class->id }}" {{ $class->id == $classStudent->class_id ? 'selected' : '' }}>{{ $class->class_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
