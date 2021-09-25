@extends('panel.admin.master')
@section('page_title')افزودن تفکیک@endsection
@section('script')

    <script src="{{ asset('assets/libs/axios/axios.min.js') }}"></script>
    <script type="text/javascript">
        document.querySelector('#base_id').addEventListener('change', function () {
            let baseId = this.value;
            if (baseId) {
                axios.get('{{ asset('/api/get-class-list/') }}' + '/' + baseId)
                    .then(function (response) {
                        $('select[name="classes"]').empty();
                        for (let item of response.data) {
                            $('select[name="classes"]').append('<option value="' + item['id'] + '">' + item['class_title'] + '</option>');
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
                        <h4 class="page-title mb-1">تفکیک پایه و کلاس </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم افزودن تفکیک جدید</li>
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
                                <h4 class="header-title"> فرم افزودن تفکیک</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.exclusives.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="azmoon_id" value="{{ $azmoon->id }}">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="base_id">پایه</label>
                                                <select autofocus class="form-control" name="base_id" id="base_id">
                                                    <option selected disabled>لطفا انتخاب کنید!</option>
                                                    @foreach($bases as $base)
                                                        <option value="{{ $base->id }}">{{ $base->base_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="class_id">کلاس</label>
                                                <select  class="form-control @error('class_id') is-invalid @enderror" name="classes" id="class_id" >
                                                    <option selected disabled>لطفا انتخاب کنید!</option>
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
