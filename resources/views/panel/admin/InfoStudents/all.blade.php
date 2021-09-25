@extends('panel.admin.master')
@section('page_title') دانش آموزان@endsection
@section('script')
    <script>

    </script>

@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">دانش آموزان</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست دانش آموزان</li>
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
                                <h4 class="header-title">فیلتر</h4>
                                <form action="{{ route('admin.students.index') }}" method="get">
                                    <div class="row justify-content-center" style="padding: 20px 0;">
                                        <div class="col-lg-3">
                                            <label for="order">مرتب ‌سازی براساس</label>
                                            <select name="orderBy" id="order" class="form-control">
                                                @foreach(['asc'=>'قدیمی','desc'=>'جدید'] as $key=>$val)
                                                    <option
                                                        value="{{ $key }}" {{ $key == $orderBy ? 'selected' : '' }}>{{ ucfirst($val) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="base">پایه</label>
                                            <select name="base" id="base" class="form-control">
                                                @foreach($bases as $q_base)
                                                    <option
                                                        value="{{ $q_base->id }}" {{ $q_base->id == $base ? 'selected' : '' }}>{{ ucfirst($q_base->base_title) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="class">کلاس</label>
                                            <select name="class" id="class" class="form-control">
                                                <option value="">همه کلاس ها</option>
                                                @foreach($classes as $q_class)
                                                    <option
                                                        value="{{ $q_class->id }}" {{ $q_class->id == $class ? 'selected' : '' }}>{{ ucfirst($q_class->class_title) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="perPage">تعداد صفحه</label>
                                            <select name="perPageBy" id="perPage" class="form-control">
                                                @foreach(['20','50','100'] as $page)
                                                    <option
                                                        value="{{ $page }}" {{ $page == $perPage ? 'selected' : '' }}>{{ ucfirst($page) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label for="q">نام یا نام خانوادگی را وارد کنید!</label>
                                            <input type="text" class="form-control" name="q" id="q" value="{{ $q }}">
                                        </div>
                                        <div class="col-lg-2 mt-2">
                                            <button class="btn btn-outline-info" style="margin-top: 30px;width: 150px;"
                                                    type="submit">
                                                <i class="ti-filter"></i>
                                                <b>فیلتر</b>

                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">لیست دانش آموزان</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($students->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>شناسه یکتا</th>
                                                <th>نام و نام خانوادگی</th>
                                                <th>پایه</th>
                                                <th>کلاس</th>
                                                <th>کد کاربری</th>
                                                <th>رمز کاربری</th>
                                                <th>اطلاعات تماس</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($students as $student)
                                                <tr>
                                                    <td>{{ $student['id'] }}</td>
                                                    <td>{{ $student['name_family'] }}</td>
                                                    <td>{{ $student['base_name'] }}</td>
                                                    <td>{{ $student['class_name'] }}</td>
                                                    <td>{{ $student['user_code'] }}</td>
                                                    <td>{{ $student['user_pass'] }}</td>
                                                    <td>
                                                        ایمیل: {{ $student['email'] }}
                                                        <br>
                                                        موبایل: {{ $student['phone'] }}

                                                    </td>

                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="{{ route('admin.students.destroy',$student['id']) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-sm">
                                                                    <a href="{{ route('admin.students.edit',$student['id']) }}" class="btn btn-warning" title="ویرایش ">
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
                                    {{ $students->appends($_GET)->links() }}
                                @else
                                    <div class="">

                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست دانش آموزان خالی می باشد!
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
