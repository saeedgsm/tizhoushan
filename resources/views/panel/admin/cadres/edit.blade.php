@extends('panel.admin.master')
@section('page_title') ویرایش اطلاعات کادر علم برتر سالار@endsection
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
    </script>
@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">کادر علم برتر سالار</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">ویرایش اطلاعات کادر علم برتر سالار</li>
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
                                <h4 class="header-title">ویرایش اطلاعات کادر علم برتر سالار</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.cadres.update',$cadre) }}" method="post">
                                    @csrf
                                    @method('patch')
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
                                                           name="first_name"
                                                           value="{{ old('first_name',$cadre->first_name) }}"
                                                           placeholder="نام را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="last_name">نام خانوادگی</label>
                                                    <input id="last_name" type="text"
                                                           class="form-control @error('last_name') is-invalid @enderror"
                                                           name="last_name"
                                                           value="{{ old('last_name',$cadre->last_name) }}"
                                                           placeholder="نام خانوادگی را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="email"><span>ایمیل: </span> <span>{{ $cadre->email }}</span></label>
                                                    <input id="email" type="text"
                                                           class="form-control @error('email') is-invalid @enderror"
                                                           name="email" value="{{ old('email') }}"
                                                           placeholder="ایمیل را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="phone"><span>موبایل: </span> <span>{{ $cadre->phone }}</span></label>
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
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Role:</strong>
                                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h5 class="font-size-14">نوع کاربری </h5>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="level1" name="level" value="agency"
                                                           class="custom-control-input @error('level') is-invalid @enderror" {{ $cadre->level == 'agency' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="level1">نمایندگی</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="level2" name="level" value="teacher"
                                                           class="custom-control-input @error('level') is-invalid @enderror" {{ $cadre->level == 'teacher' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="level2">استاد</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="level3" name="level" value="admin"
                                                           class="custom-control-input @error('level') is-invalid @enderror" {{ $cadre->level == 'admin' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="level3">کادر دفتری</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-2 mt-3">
                                                <h5 class="font-size-14">وضعیت دسترسی </h5>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="block2" name="block" value="1"
                                                           class="custom-control-input @error('block') is-invalid @enderror" {{ $cadre->block == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="block2">فعال</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="block3" name="block" value="0"
                                                           class="custom-control-input @error('block') is-invalid @enderror" {{ $cadre->block == 0 ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="block3">غیر
                                                        فعال</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="state">استان </label>
                                                    <select autofocus
                                                            class="form-control  @error('state_id') is-invalid @enderror"
                                                            name="state_id" id="state">
                                                        <option value="">لطفا انتخاب کنید!</option>
                                                        @foreach($states as $state)
                                                            <option
                                                                value="{{ $state->id }}" {{ $info->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="city_id">شهر </label>
                                                    <select autofocus
                                                            class="form-control  @error('city_id') is-invalid @enderror"
                                                            name="city_id" id="city_id">

                                                        <option disabled selected>انتخاب نشده است!</option>
                                                        @foreach($cities as $city)
                                                            <option
                                                                value="{{ $city->id }}" {{ $info->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
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
