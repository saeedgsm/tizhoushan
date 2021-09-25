@extends('panel.student.master')

@section('page_title')  ویرایش اطلاعات کاربری @endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('persianDatepicker-master/css/persian-datepicker.min.css') }}"/>
@endsection
@section('script')
    <script src="{{ asset('persianDatepicker-master/js/persian-date.min.js') }}"></script>
    <script src="{{ asset('persianDatepicker-master/js/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/axios/axios.min.js') }}"></script>
    <script src="{{ asset('assets/js/student-edit.js') }}"></script>
    <script type="text/javascript">
        getCustomFields({{ auth()->id() }});
        document.querySelector('#state').addEventListener('click', function () {
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
                });
            }
        });
        getCustomFieldValues({{ auth()->id() }})
    </script>

@endsection
@section('content')
    <div class="page-content">
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ویرایش اطلاعات</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">فرم ویرایش اطلاعات</h4>
                                <p class="card-title-desc"></p>
                                <div class="">
                                    <hr>
                                    <div class="col-lg-12 p-2">
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <span><strong> توجه! </strong>دانش آموز عزیز لطفا قسمت های ستاره دار را پر
                                                کنید!
                                            </span>
                                            <span><strong> توجه! </strong>تصویر پروفایل در اندازه 3*4 و با زمینه سفید وارد
                                                کنید!
                                            </span>
                                        </div>
                                    </div>
                                    @if($cols['email'] == 1)
                                        @if(auth()->user()->email == null)
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <strong> توجه! </strong>لطفا ایمیل خود را وارد کنید!
                                            </div>
                                        @endif
                                    @endif
                                    @if($cols['phone'] == 1)
                                        @if( auth()->user()->phone == null )
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <strong>توجه!</strong>لطفا موبایل خود را وارد کنید!
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="p-3">
                                    @include('alert_messages.alerts')
                                    <div class="col-lg-12">
                                        <form action="{{ route('student.panel.update') }}" method="post"
                                              class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <div class="row">
                                                @if($cols['first_name'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="name" class="control-label">نام
                                                                <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="first_name"
                                                                   id="name" autocomplete="off"
                                                                   placeholder="اسم کوچک را وارد کنید" autofocus
                                                                   value="{{ old('first_name',$user->first_name) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['last_name'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="last_name" class="control-label">نام خانوادگی
                                                                <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="last_name"
                                                                   id="last_name" autocomplete="off"
                                                                   placeholder="نام خانوادگی را وارد کنید"
                                                                   value="{{ old('last_name',$user->last_name) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['father'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="father" class="control-label">نام پدر
                                                                <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="father"
                                                                   id="father" autocomplete="off"
                                                                   placeholder="نام پدر را وارد کنید"
                                                                   value="{{ old('father',$user->student->father) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['school_name'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="school_name" class="control-label">نام مدرسه
                                                                <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="school_name"
                                                                   id="school_name" autocomplete="off"
                                                                   placeholder="نام مدرسه را وارد کنید"
                                                                   value="{{ old('school_name',$user->student->school_name) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['tel_home'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="tel_home" class="control-label">تلفن منزل
                                                                <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="tel_home"
                                                                   id="tel_home" autocomplete="off"
                                                                   placeholder="تلفن منزل را وارد کنید"
                                                                   value="{{ old('tel_home',$user->student->tel_home) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['tel_parent'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="tel_parent" class="control-label">شماره همراه
                                                                پدر یا مادر
                                                                <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="tel_parent"
                                                                   id="tel_parent" autocomplete="off"
                                                                   placeholder="شماره همراه پدر یا مادر را وارد کنید"
                                                                   value="{{ old('tel_parent',$user->student->tel_parent) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['hamgam_code'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="hamgam_code" class="control-label">شماره همگام
                                                                <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="hamgam_code"
                                                                   id="hamgam_code" autocomplete="off"
                                                                   placeholder="شماره همگام را وارد کنید"
                                                                   value="{{ old('hamgam_code',$user->student->hamgam_code) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['birthdate'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="birthdate" class="control-label">تاریخ تولد
                                                                <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="birthdate"
                                                                   id="birthdate" autocomplete="off" readonly
                                                                   placeholder="تاریخ تولد را وارد کنید"
                                                                   value="{{ old('birthdate',$user->student->birthdate) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['melli'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="melli" class="control-label">کد ملی
                                                                <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="melli"
                                                                   id="melli" autocomplete="off"
                                                                   placeholder="کد ملی را وارد کنید"
                                                                   value="{{ old('melli',$user->student->melli) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['state_id'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="state">استان </label>
                                                            <select autofocus
                                                                    class="form-control  @error('state_id') is-invalid @enderror"
                                                                    name="state_id" id="state">
                                                                <option value="">لطفا انتخاب کنید!</option>
                                                                @foreach($states as $state)
                                                                    <option
                                                                            value="{{ $state->id }}" {{ $stInfo->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="city_id">شهر </label>
                                                            <select autofocus
                                                                    class="form-control  @error('city_id') is-invalid @enderror"
                                                                    name="city_id" id="city_id">

                                                                <option disabled selected>انتخاب نشده است!</option>
                                                                @foreach($cities as $city)
                                                                    <option
                                                                            value="{{ $city->id }}" {{ $stInfo->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['email'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="email" class="control-label">ایمیل فعلی
                                                                : {{ $user->email }} </label>
                                                            <input type="email" class="form-control" name="email"
                                                                   id="email" autocomplete="off"
                                                                   placeholder="ایمیل جدید را وارد کنید"
                                                                   value="{{ old('email') }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['phone'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="phone" class="control-label">موبایل فعلی
                                                                : {{ $user->phone }} </label>
                                                            <input type="number" class="form-control" name="phone"
                                                                   id="phone" autocomplete="off"
                                                                   placeholder="شماره جدید موبایل را وارد کنید"
                                                                   value="{{ old('phone') }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['password'] == 1)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="password" class="control-label">کلمه
                                                                عبور </label>
                                                            <input type="password" class="form-control" name="password"
                                                                   id="password" autocomplete="off"
                                                                   placeholder="کلمه عبور جدید را وارد کنید"
                                                                   value="{{ old('password') }}">

                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="password-confirm" class="control-label">تکرار
                                                                کلمه
                                                                عبور </label>
                                                            <input type="password" class="form-control"
                                                                   name="password_confirmation"
                                                                   id="password-confirm" autocomplete="off"
                                                                   placeholder="تکرار کلمه عبور جدید را وارد کنید"
                                                                   value="{{ old('password-confirm') }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($cols['avatar'] == 1)
                                                    <div class="col-md-3 mb-3">
                                                        <label>عکس پروفایل</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="avatar"
                                                                   id="validationCustomFile">
                                                            <label class="custom-file-label" for="validationCustomFile">انتخاب
                                                                عکس پروفایل...</label>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div id="custom_field" class="row"></div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">
                                                        ثبت اطلاعات
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                        تازه سازی فرم
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
    <!-- End Page-content -->

@endsection
