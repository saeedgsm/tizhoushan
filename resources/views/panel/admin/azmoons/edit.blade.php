@extends('panel.admin.master')
@section('page_title')ویرایش آزمون@endsection
@section('style')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css"/>

@endsection
@section('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-en_US.min.js"></script>

    <script>
        let azmoon_types = document.getElementsByName("azmoon_type");
        let booksElement = document.getElementById('book');
        $(function () {
           // checkBookSelectClass();
            let ss = $('select').selectpicker();
            addRemoveSelectClass();
        });
        function checkBookSelectClass() {
            azmoon_types.forEach((azmoon_type) => {
                if (azmoon_type.checked) {
                    if (azmoon_type.value === 'normal'){
                        booksElement.classList.remove('selectpicker');
                        booksElement.removeAttribute('multiple');
                    }
                }
            });
        }

        function addRemoveSelectClass() {
            azmoon_types.forEach((azmoon_type) => {
                azmoon_type.addEventListener('change', event => {
                    let azmoon_type = event.path[0];
                    //console.log(azmoon_type.value);
                    if (azmoon_type.value === 'normal'){
                        booksElement.classList.remove('selectpicker');
                        booksElement.removeAttribute('multiple');
                       // console.log(booksElement)
                    }else if (azmoon_type.value === 'advanced'){
                        $(function () {
                            //checkBookSelectClass();
                            //let ss = $('select').selectpicker();
                            //addRemoveSelectClass();
                        });
                        booksElement.classList.add('selectpicker');
                        booksElement.setAttribute('multiple','');
                       // console.log(booksElement)
                    }
                });
            });
        }
    </script>
    <script type="text/javascript">


        $(document).ready(function () {

            // select of books



           // console.log(booksElement.attributes)


            let azmoon_sync_time = document.querySelector('#azmoon_sync_time');
            document.querySelector('#azmoon_sync').addEventListener('change',function () {
                if (this.checked === true){
                    azmoon_sync_time.classList.remove("d-none")
                }else {
                    azmoon_sync_time.classList.add('d-none');
                }
            });
            let price = document.querySelector('#price');
            document.querySelector('#type_payment1').addEventListener('change',function () {
                if (this.checked === true){
                    price.classList.add("d-none")
                }
            });
            document.querySelector('#type_payment2').addEventListener('change',function () {
                if (this.checked === true){
                    price.classList.remove("d-none")
                }
            })

            $("#start_date_alt").persianDatepicker(
                {
                    observer: true,
                    format: 'YYYY/MM/DD H:m',
                    altField: '.start_date',
                    minDate: new persianDate().add('day', -1).valueOf(),
                    initialValue: false,
                    timePicker: {
                        enabled: true,
                        meridiem: {
                            enabled: false
                        },


                    }
                }
            );
            $("#end_date_alt").persianDatepicker(
                {
                    observer: true,
                    format: 'YYYY/MM/DD H:m',
                    altField: '.end_date',
                    initialValue: false,
                    minDate: new persianDate().add('day', -1).valueOf(),
                    timePicker: {
                        enabled: true,
                        meridiem: {
                            enabled: false
                        }
                    }
                }
            );
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
                        <h4 class="page-title mb-1">آزمون</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم ویرایش آزمون </li>
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
                                <h4 class="header-title"> فرم ویرایش آزمون</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.azmoons.update',$azmoon) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 p-2">
                                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <strong> توجه! </strong>کد آزمون در صورت خالی وارد کردن به صورت رندوم ایجاد خواهد شد!
                                                <hr>
                                                <strong> توجه! </strong>لطفا در انتخاب کردن کتاب نسبت به نوع آزمون دقت کنید!
                                            </div>
                                        </div>

                                        <div class="row col-lg-12 p-5">
                                            <div class="col-lg-2 mb-3">
                                                <h5 class="font-size-14">وضعیت آزمون </h5>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="azmoon_status2" name="azmoon_status"
                                                           value="{{ old('azmoon_status','1') }}" autocomplete="off"
                                                           class="custom-control-input" {{ $azmoon->azmoon_status == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                           for="azmoon_status2">فعال</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="azmoon_status3" name="azmoon_status"
                                                           value="{{ old('azmoon_status','0') }}"
                                                           class="custom-control-input" {{ $azmoon->azmoon_status == 0 ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                           for="azmoon_status3">غیر فعال</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <h5 class="font-size-14">نوع آزمون </h5>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="azmoon_type2" name="azmoon_type"
                                                           value="{{ old('azmoon_type','normal') }}" autocomplete="off"
                                                           class="custom-control-input" {{ $azmoon->azmoon_type == 'normal' ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                           for="azmoon_type2">عادی</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="azmoon_type3" name="azmoon_type"
                                                           value="{{ old('azmoon_type','advanced') }}"
                                                           class="custom-control-input" {{ $azmoon->azmoon_type == 'advanced' ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                           for="azmoon_type3">پیشرفته</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <h5 class="font-size-14">نوع سوال </h5>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="type2" name="type"
                                                           value="porseshnameh"
                                                           class="custom-control-input" {{ $soal->type == 'porseshnameh' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="type2">پرسش
                                                        نامه </label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="type3" name="type" value="soal_b_soal"
                                                           class="custom-control-input" {{ $soal->type == 'soal_b_soal' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="type3">سوال به
                                                        سوال</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <div>
                                                    <h5 class="font-size-14 mb-3">همگام سازی زمان آزمون</h5>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="azmoon_sync"
                                                               value="1" id="azmoon_sync">
                                                        <label class="form-check-label" for="azmoon_sync">
                                                            ثبت تاخیر دانش آموزان
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-3 d-none" id="azmoon_sync_time">
                                                <label for="azmoon_sync_time">مدت زمان تاخیر به دقیقه</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="azmoon_sync_time" autocomplete="off"
                                                       value="{{ old('azmoon_sync_time') }}"
                                                       id="azmoon_sync_time" placeholder="مدت زمان تاخیر را وارد کنید">
                                                @error('error')
                                                <ul class="parsley-errors-list is-invalid"
                                                    id="parsley-id-5" aria-hidden="false">
                                                    <li class="parsley-required">مدت زمان تاخیر را وارد کنید</li>
                                                </ul>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row col-lg-12 p-3">
                                            <div class="col-lg-3 mb-3">
                                                <div class="form-group">
                                                    <label for="book">کتاب </label>
                                                    <select autofocus
                                                            class="selectpicker form-control @error('book_id') is-invalid @enderror"
                                                            name="book_id[]"
                                                            id="book" multiple>
                                                        <option disabled>لطفا انتخاب کنید!</option>
                                                        @foreach($books as $book)
                                                            <option value="{{ $book->id }}" {{ in_array($book->id,$azmoon->azmoonBooks()->pluck('book_id')->toArray()) ? 'selected' : '' }}>{{ $book->book_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-3">
                                                <label for="azmoon_title">نام آزمون</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="azmoon_title" autocomplete="off"
                                                       value="{{ old('azmoon_title',$azmoon->azmoon_title) }}"
                                                       id="azmoon_title" placeholder="نام آزمون را وارد کنید">
                                                @error('error')
                                                <ul class="parsley-errors-list is-invalid"
                                                    id="parsley-id-5" aria-hidden="false">
                                                    <li class="parsley-required">نام آزمون را وارد کنید</li>
                                                </ul>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 mb-3">
                                                <label for="azmoon_code">کد آزمون</label>
                                                <input type="text" title="در صورت خالی بودن کد به صورت رندم ایجاد می شود!"
                                                       class="form-control"
                                                       name="azmoon_code" autocomplete="off"
                                                       value="{{ old('azmoon_code',$azmoon->azmoon_code ) }}"
                                                       id="azmoon_code" placeholder="کد آزمون را وارد کنید">
                                                @error('error')
                                                <ul class="parsley-errors-list is-invalid"
                                                    id="parsley-id-5" aria-hidden="false">
                                                    <li class="parsley-required">کد آزمون را وارد کنید</li>
                                                </ul>
                                                @enderror
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <h5 class="font-size-14">نوع هزینه </h5>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="type_payment1" name="type_payment"
                                                           value="free"
                                                           class="custom-control-input" {{ $azmoon->type_payment == 'free' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="type_payment1">رایگان</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="type_payment2" name="type_payment" value="cash"
                                                           class="custom-control-input" {{ $azmoon->type_payment == 'cash' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="type_payment2">پولی</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-3 d-none" id="price">
                                                <label for="price">هزینه آزمون تومان</label>
                                                <input type="text" title="هزینه آزمون به تومان وارد کنید!"
                                                       class="form-control"
                                                       name="price" autocomplete="off"
                                                       value="{{ old('price',$azmoon->price) }}"
                                                       id="price" placeholder="هزینه آزمون را وارد کنید">
                                                @error('error')
                                                <ul class="parsley-errors-list is-invalid"
                                                    id="parsley-id-5" aria-hidden="false">
                                                    <li class="parsley-required">هزینه آزمون را وارد کنید</li>
                                                </ul>
                                                @enderror
                                            </div>

                                        </div>


                                        <div class="row p-5">
                                            <div class="col-lg-4 mb-3">
                                                <label for="soal_count">تعداد سوال</label>
                                                <input type="text" autocomplete="off"
                                                       class="form-control"
                                                       name="soal_count"
                                                       value="{{ old('soal_count',$soal->soal_count) }}"
                                                       id="soal_count" placeholder="تعداد سوال را وارد کنید">
                                                @error('error')
                                                <ul class="parsley-errors-list is-invalid"
                                                    id="parsley-id-5" aria-hidden="false">
                                                    <li class="parsley-required">تعداد سوال را وارد کنید</li>
                                                </ul>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="answer_type">نوع نمایش گزینه ها</label>
                                                <select autofocus class="form-control @error('answer_type') is-invalid @enderror" name="answer_type" id="answer_type">
                                                    <option selected disabled>لطفا انتخاب کنید!</option>
                                                    <option value="num" {{ $soal->answer_type == 'num' ? 'selected' : '' }}>به صورت 1 2 3 4</option>
                                                    <option value="latin" {{ $soal->answer_type == 'latin' ? 'selected' : '' }}>الف ب ج د</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label>کاور آزمون </label>
                                                <div class="custom-file">
                                                    <input type="file" class="form-control-file" name="soal_cover"
                                                           id="soal_cover">
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
