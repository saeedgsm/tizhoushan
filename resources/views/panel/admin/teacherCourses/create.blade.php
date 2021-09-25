@extends('panel.admin.master')
@section('page_title')ثبت دوره برای استاد@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ثبت دوره برای استاد </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">ثبت دوره برای استاد</li>
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
                                <h4 class="header-title"> فرم ثبت دوره برای استاد </h4>
                                <p class="card-title-desc">
                                    {{ $teacher->first_name }} {{ $teacher->last_name }}
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.teacherCourses.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $teacher->id }}">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="course_id">عنوان پایه</label>
                                            <select name="course_id" id="course_id" class="form-control">
                                                @foreach($courses as $course)
                                                    <option value="{{ $course['id'] }}">{{ $course['course_title'] }}</option>
                                                @endforeach
                                            </select>
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
