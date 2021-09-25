@extends('panel.admin.master')
@section('page_title') کارکنان علم برتر سالار@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">کارکنان علم برتر سالار</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست کارکنان علم برتر سالار</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a href="{{ route('admin.cadres.create') }}" class="btn btn-light btn-rounded ">
                                <i class="mdi mdi-plus-outline mr-1"></i> افزودن کاربر
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
                                <h4 class="header-title">فیلتر</h4>
                                <form action="{{ route('admin.cadres.index') }}" method="get">
                                    <div class="row justify-content-center" style="padding: 20px 0;">
                                        <div class="col-lg-3">
                                            <label for="order">مرتب ‌سازی براساس</label>
                                            <select name="orderBy" id="order" class="form-control">
                                                @foreach(['asc'=>'قدیمی ترین','desc'=>' جدیدترین'] as $key=>$val)
                                                    <option value="{{ $key }}" {{ $key == $orderBy ? 'selected' : '' }}>{{ ucfirst($val) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="level">مرتب‌ سازی براساس نوع کاربران</label>
                                            <select name="level" id="level" class="form-control">
                                                @foreach(['teacher'=>'اساتید','agency'=>'نمایندگان','office'=>'کارکنان مجموعه'] as $key=>$val)
                                                    <option value="{{ $key }}" {{ $key == $level ? 'selected' : '' }}>{{ ucfirst($val) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="perPage">تعداد صفحه</label>
                                            <select name="perPageBy" id="perPage" class="form-control">
                                                @foreach(['20','50','100'] as $page)
                                                    <option value="{{ $page }}" {{ $page == $perPage ? 'selected' : '' }}>{{ ucfirst($page) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label for="q">نام یا نام خانوادگی را وارد کنید!</label>
                                            <input type="text" class="form-control" name="q" id="q" value="{{ $q }}">
                                        </div>
                                        <div class="col-lg-2 mt-2" >
                                            <button class="btn btn-outline-info" style="margin-top: 30px;width: 150px;" type="submit">
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
                                <h4 class="header-title">لیست کارکنان علم برتر سالار</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($users->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>نام و نام خانوادگی</th>
                                                <th>اطلاعات تماس</th>
                                                <th>سطح کاربری</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $cadre)
                                                <tr>
                                                    <td>{{ $cadre->first_name }} {{ $cadre->last_name }}</td>
                                                    <td>
                                                        ایمیل: {{ $cadre->email }}
                                                        <br>
                                                        موبایل: {{ $cadre->phone }}

                                                    </td>
                                                    <td>
                                                        @switch($cadre->level)
                                                            @case('agency')
                                                            نمایندگی
                                                            @break
                                                            @case('teacher')
                                                            استاد
                                                            @break
                                                            @case('office')
                                                            کارکنان مجموعه
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="{{ route('admin.cadres.destroy',$cadre) }}"
                                                                  method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-xs">
                                                                    <a href="#"
                                                                       class="btn btn-info" title="تعریف سطح دسترسی ">
                                                                        <b>سطح دسترسی</b>
                                                                        <i class="ti-hand-open"></i>
                                                                    </a>
                                                                    <a href="{{ route('admin.cadres.edit',$cadre) }}"
                                                                       class="btn btn-warning" title="ویرایش ">
                                                                        <b>ویرایش</b>
                                                                        <i class="ti-pencil-alt"></i>
                                                                    </a>
                                                                    <button
                                                                        onclick="return confirm('از حذف دانش آموز مطمئن هستید؟')"
                                                                        type="submit" class="btn btn-danger"
                                                                        title="حذف ">
                                                                        <b>حذف</b>
                                                                        <i class="ti-trash"></i>
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
                                    {{ $users->appends($_GET)->links() }}
                                @else
                                    <div class="">

                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست کارکنان علم برتر سالار خالی می باشد!
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
