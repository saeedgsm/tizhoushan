@extends('panel.admin.master')
@section('page_title')ویرایش کاور پیش فرض@endsection

@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">کاور پیش فرض </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم ویرایش کاور پیش فرض</li>
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
                                <h4 class="header-title"> فرم ویرایش کاور پیش فرض</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.defaultCovers.update',$defaultCover) }}"
                                      enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="cover_name">عنوان کاور</label>
                                            <input type="text" autofocus
                                                   class="form-control"
                                                   name="cover_name"
                                                   value="{{ old('cover_name',$defaultCover->cover_name) }}"
                                                   id="cover_name" placeholder="عنوان کاور را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان کاور را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="cover_loc"><span>قسمت مورد استفاده </span> <span
                                                    class="text-danger">به لاتین</span></label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="cover_loc"
                                                   value="{{ old('cover_loc',$defaultCover->cover_loc) }}"
                                                   id="cover_loc" placeholder="قسمت مورد استفاده به لاتین را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">قسمت مورد استفاده به لاتین را وارد کنید
                                                </li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <img src="{{ asset($defaultCover->cover_url) }}"
                                                 class="img-fluid rounded"
                                                 width="200"
                                                 alt="cover">
                                        </div>

                                        <div class="col-lg-4 mb-3">
                                            <label>کاور پیش فرض </label>
                                            <div class="custom-file">
                                                <input type="file" class="form-control-file" name="cover_url"
                                                       id="cover_url">
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
