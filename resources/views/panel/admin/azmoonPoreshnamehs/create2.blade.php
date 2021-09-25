@extends('panel.admin.master')
@section('page_title')افزودن گزینه سوالات@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">گزینه سوالات آزمون </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><span>فرم افزودن گزینه سوال جدید برای آزمون</span> <span style="font-size: larger;color: white">{{ $azmoon->azmoon_title }}</span></li>
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
                                <h4 class="header-title"> فرم افزودن گزینه سوال</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.porseshnamehs.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="azmoon_id" value="{{ $azmoon->id }}">
                                    <div class="row">



                                        <div class="col-md-2 mb-3">
                                            <label for="number_of_question">شماره سوال </label>
                                            <input type="number"
                                                   min="1"
                                                   max="300"
                                                   class="form-control"
                                                   name="number_of_question"
                                                   value="{{ old('number_of_question') }}"
                                                   id="number_of_question" title="شماره سوال وارد کنید" placeholder="">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">شماره سوال را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="key"> گزینه صحیح </label>
                                                <select autofocus class="form-control  @error('key') is-invalid @enderror" name="key" id="key">
                                                    <option selected disabled>لطفا انتخاب کنید!</option>
                                                    <option value="a">گزینه اول</option>
                                                    <option value="b">گزینه دوم</option>
                                                    <option value="c">گزینه سوم</option>
                                                    <option value="d">گزینه چهارم</option>
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
                                            <a href="{{ route('admin.azmoons.show',$azmoon) }}"
                                               class="btn btn-info waves-effect m-l-5">
                                                برگشت به آزمون
                                            </a>
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
