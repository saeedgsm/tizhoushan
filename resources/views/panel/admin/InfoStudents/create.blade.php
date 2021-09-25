@extends('panel.admin.master')
@section('page_title') افزودن دانش آموز@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        document.querySelector('#state').addEventListener('change', function () {
            let stateId = this.value;
            if (stateId) {
                axios.get('{{ asset('/api/get-city-list/') }}' + '/' + stateId)
                    .then(function (response) {
                        $('select[name="city_id"]').empty();
                        for (let item of response.data) {
                            $('select[name="city_id"]').append('<option value="' + item['id'] + '">' + item['name'] + '</option>');
                        }
                    }).catch(function (error) {
                    console.log(error)
                })
            }
        });
        document.querySelector('#base_id').addEventListener('change', function () {
            let baseId = this.value;
            console.log(baseId)
            if (baseId) {
                axios.get('{{ asset('/api/get-class-list/') }}' + '/' + baseId)
                    .then(function (response) {
                        $('select[name="class_id"]').empty();

                        for (let item of response.data) {
                            console.log()
                            $('select[name="class_id"]').append('<option value="' + item['id'] + '">' + item['class_title'] + '</option>');
                        }
                    }).catch(function (error) {
                    console.log(error)
                })
            }
        });
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
                            <li class="breadcrumb-item active">افزودن دانش آموز</li>
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
                                <h4 class="header-title">افزودن دانش آموز</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.students.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 mt-5">
                                            <h4 class="form-section"><i class="mdi mdi-account"></i>پایه و کلاس های آموزشی</h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="base_id">پایه آموزشی </label>
                                            <select name="base_id" id="base_id" class="form-control">
                                                <option selected disabled>لطفا انتخاب کنید!</option>
                                                @foreach($bases as $base)
                                                    <option value="{{ $base->id }}">{{ $base->base_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="class_id">عنوان کلاس</label>
                                            <select name="class_id" id="class_id" class="form-control">
                                                <option selected disabled>لطفا انتخاب کنید!</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="user">
                                        <div class="col-lg-12 mt-5">
                                            <h4 class="form-section"><i class="mdi mdi-account"></i>اطلاعات اصلی</h4>
                                            <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="first_name">نام </label>
                                                    <input id="first_name" type="text"
                                                           class="form-control @error('first_name') is-invalid @enderror"
                                                           name="first_name" value="{{ old('first_name') }}"
                                                           placeholder="نام را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="last_name">نام خانوادگی</label>
                                                    <input id="last_name" type="text"
                                                           class="form-control @error('last_name') is-invalid @enderror"
                                                           name="last_name" value="{{ old('last_name') }}"
                                                           placeholder="نام خانوادگی را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="usercode">کد کاربری</label>
                                                    <input id="usercode" type="text"
                                                           class="form-control @error('usercode') is-invalid @enderror"
                                                           name="usercode" value="{{ old('usercode') }}"
                                                           placeholder="کد کاربری را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="email">ایمیل</label>
                                                    <input id="email" type="text"
                                                           class="form-control @error('email') is-invalid @enderror"
                                                           name="email" value="{{ old('email') }}"
                                                           placeholder="ایمیل را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="phone">موبایل</label>
                                                    <input id="phone" type="text"
                                                           class="form-control @error('phone') is-invalid @enderror"
                                                           name="phone" value="{{ old('phone') }}"
                                                           placeholder="موبایل را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="password" class="control-label">کلمه عبور </label>
                                                    <input type="password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           name="password"
                                                           id="password"
                                                           placeholder="کلمه عبور جدید را وارد کنید"
                                                           value="{{ old('password') }}">

                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="password-confirm" class="control-label">تکرار کلمه
                                                        عبور </label>
                                                    <input type="password"
                                                           class="form-control @error('password-confirm') is-invalid @enderror"
                                                           name="password_confirmation"
                                                           id="password-confirm"
                                                           placeholder="تکرار کلمه عبور جدید را وارد کنید"
                                                           value="{{ old('password-confirm') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">وضعیت دسترسی </h5>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="block2" name="block" value="1"
                                                           class="custom-control-input @error('block') is-invalid @enderror">
                                                    <label class="custom-control-label" for="block2">فعال</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="block3" name="block" value="0"
                                                           class="custom-control-input @error('block') is-invalid @enderror" checked="">
                                                    <label class="custom-control-label" for="block3">غیر
                                                        فعال</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="student">
                                        <div class="col-lg-12 mt-5">
                                            <h4 class="form-section"><i class="mdi mdi-account-box"></i>اطلاعات دانش
                                                آموزشی</h4>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="melli">کد ملی</label>
                                                    <input id="melli" type="text"
                                                           class="form-control @error('melli') is-invalid @enderror"
                                                           name="melli" value="{{ old('melli') }}"
                                                           placeholder="کد ملی را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="father">نام پدر</label>
                                                    <input id="father" type="text"
                                                           class="form-control @error('father') is-invalid @enderror"
                                                           name="father" value="{{ old('father') }}"
                                                           placeholder="نام پدر را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="state">استان </label>
                                                    <select autofocus class="form-control  @error('state_id') is-invalid @enderror" name="state_id" id="state">
                                                        <option value="">لطفا انتخاب کنید!</option>
                                                        @foreach($states as $state)
                                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="city_id">شهر </label>
                                                    <select autofocus class="form-control  @error('city_id') is-invalid @enderror" name="city_id" id="city_id">
                                                        <option value="">لطفا انتخاب کنید!</option>>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <h5 class="font-size-14">جنسیت </h5>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="gender1" name="gender" value="unselect"
                                                           class="custom-control-input" checked>
                                                    <label class="custom-control-label" for="gender1">انتخاب
                                                        نشده</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="gender2" name="gender" value="male"
                                                           class="custom-control-input">
                                                    <label class="custom-control-label" for="gender2">پسر</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="gender3" name="gender" value="female"
                                                           class="custom-control-input">
                                                    <label class="custom-control-label" for="gender3">دختر</label>
                                                </div>
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
