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
                                <?php for ($i=1;$i<=$soal->soal_count;$i++) { ?>
                                <div class="row justify-content-center">

                                    <div class="col-md-2 mb-3">
                                        <label for="number_of_question">شماره سوال </label>
                                        <input type="text"
                                               min="1" readonly
                                               max="300"
                                               class="form-control"
                                               name="number_of_question"
                                               value="{{ old('number_of_question',$i) }}"
                                               id="number_of_question" title="شماره سوال وارد کنید" placeholder="">
                                        @error('error')
                                        <ul class="parsley-errors-list is-invalid"
                                            id="parsley-id-5" aria-hidden="false">
                                            <li class="parsley-required">شماره سوال را وارد کنید</li>
                                        </ul>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="key"> گزینه صحیح </label>
                                            <div class="row">
                                                <h5 class="font-size-14 mb-3 p-3"></h5>
                                                <?php for ($loopRadio=1;$loopRadio<=4;$loopRadio++) {
                                                $radioStr = $i . "_" . $loopRadio;?>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="custominlineRadio{{ $radioStr }}" name="{{ $i }}" value="{{ $loopRadio }}" class="custom-control-input">
                                                    <label class="custom-control-label" for="custominlineRadio{{ $radioStr }}"> {{ $loopRadio }}</label>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="row justify-content-center">
                                    <div class="col-lg-12 ">
                                        <div class="form-group mt-4">
                                            <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light btn-sm">
                                                ثبت اطلاعات
                                            </button>
                                            <button type="reset"
                                                    class="btn btn-secondary waves-effect m-l-5 btn-sm">
                                                تازه سازی فرم
                                            </button>
                                            <a href="{{ route('admin.azmoons.show',$azmoon) }}"
                                               class="btn btn-info waves-effect m-l-5 btn-sm">
                                                برگشت به آزمون
                                            </a>
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
