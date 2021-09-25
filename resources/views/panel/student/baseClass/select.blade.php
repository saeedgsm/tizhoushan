@extends('panel.student.master')

@section('page_title')  ثبت نام  @endsection
@section('style')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/axios/axios.min.js') }}"></script>

    <script type="text/javascript">


        document.querySelector('#base_id').addEventListener('click', function () {
            let baseId = this.value;
            if (baseId) {
                axios.get('{{ asset('/api/get-class-list/') }}' + '/' + baseId)
                    .then(function (response) {
                        $('select[name="class_id"]').empty();
                        $('select[name="class_id"]').append('<option value="">' + 'لطفا کلاس را انتخاب کنید!' + '</option>');
                        for (let item of response.data) {
                            if (item.registrable === 1) {
                                $('select[name="class_id"]').append('<option value="' + item['id'] + '">' + item['class_title'] + '</option>');
                            }

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
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">انتخاب کلاس و پایه</h4>
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
                                <h4 class="">انتخاب پایه و کلاس آموزشی</h4>
                                <p class="card-title-desc"></p>
                                <div class="">
                                    <hr>
                                    <div class="col-lg-12 p-2">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <span><strong> توجه! </strong>لطفا پایه و کلاس خود را مشخص کنید.</span>
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        <div class="col-lg-12">
                                            <form action="{{ route('student.register.update') }}" method="post"
                                                  class="form-horizontal" enctype="multipart/form-data">
                                                @csrf
                                                @method('post')
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="base_id" class="control-label">پایه آموزشی
                                                                <span style="color: red;">*</span></label>
                                                            <select name="base_id" id="base_id" class="form-control"
                                                                    required>
                                                                <option value="">لطفا پایه را انتخاب کنید!</option>
                                                                @foreach($bases as $base)
                                                                    <option
                                                                        value="{{ $base->id }}">{{ $base->base_title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="class_id" class="control-label">کلاس آموزشی
                                                                <span style="color: red;">*</span></label>
                                                            <select name="class_id" id="class_id" class="form-control"
                                                                    required>
                                                                <option value="">لطفا پایه را انتخاب کنید!</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <input type="submit" value="ثبت پایه "
                                                                   style="margin-top: 30px;" class="btn btn-info mr-3">
                                                        </div>
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
            </div>
        </div>
    </div>
@endsection
