@extends('panel.admin.master')
@section('page_title')جزئیات آزمون@endsection
@section('style')
    <!-- Lightbox css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/assets/css/button.css') }}" rel="stylesheet" type="text/css"/>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"
            integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ=="
            crossorigin="anonymous"></script>
    <!-- Magnific Popup-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>


        function copyToClipboard(element) {
            let azmoon_link = document.getElementById('link-azmoon')['href'];
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(azmoon_link).select();
            document.execCommand("copy");
            $temp.remove();
            alert("لینک آزمون کپی شد! ");
        }
    </script>
@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">آزمون</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">جزئیات آزمون</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        @if($azmoon->azmoon_type == 'normal')
                            @if($soal->type == 'porseshnameh')
                                <div class="float-right  d-md-block">
                                    <a href="{{ route('admin.porseshnamehs.create',['azmoon'=>$azmoon]) }}"
                                       class="btn btn-light btn-rounded dropdown-toggle btn-sm"><i
                                            class="dripicons-plus mr-1"></i>
                                        <b>افزودن سوالات پرسشنامه</b>
                                    </a>
                                </div>
                                <div class="float-right  d-md-block">
                                    <a href="{{ route('admin.azmoonSoalatFiles.create',['azmoon'=>$azmoon]) }}"
                                       class="btn btn-light btn-rounded dropdown-toggle btn-sm"><i
                                            class="dripicons-plus mr-1"></i>
                                        <b>افزودن فایل سوالات</b>
                                    </a>
                                </div>
                            @elseif($soal->type == 'soal_b_soal')
                                <div class="float-right d-md-block">
                                    <a href="{{ route('admin.soalbsoals.create',['azmoon'=>$azmoon]) }}"
                                       class="btn btn-light btn-rounded dropdown-toggle btn-sm"><i
                                            class="dripicons-plus mr-1"></i>
                                        <b>افزودن سوالات سوال به سوال</b>
                                    </a>
                                </div>
                            @endif
                        @elseif($azmoon->azmoon_type == 'advanced')
                            @if($soal->type == 'porseshnameh')

                                <div class="float-right  d-md-block">
                                    <a href="{{ route('admin.advanced.porseshname.file.create',['azmoon'=>$azmoon]) }}"
                                       class="btn btn-light btn-rounded dropdown-toggle btn-sm"><i
                                            class="dripicons-plus mr-1"></i>
                                        <b>افزودن فایل سوالات</b>
                                    </a>
                                </div>
                            @elseif($soal->type == 'soal_b_soal')
                                <div class="float-right d-md-block">
                                    <a href="{{ route('admin.soalbsoals.create',['azmoon'=>$azmoon]) }}"
                                       class="btn btn-light btn-rounded dropdown-toggle  btn-sm"><i
                                            class="dripicons-plus mr-1"></i>
                                        <b>افزودن سوالات سوال به سوال</b>
                                    </a>
                                </div>
                            @endif
                        @endif

                    </div>
                    <div class="col-md-12">
                        <div class="p-4">


                            <a href="{{ route('admin.azmoon.reports',$azmoon->id) }}"
                               class="btn btn-info text-white btn-sm"> گزارش اکسل</a>

                            <div class="btn-group mr-1 mt-1">
                                <button type="button" class="btn btn-outline-success dropdown-toggle btn-sm"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">گزارش لحظه ای <i
                                        class="mdi mdi-chevron-down"></i></button>
                                <div class="dropdown-menu" style="">
                                <!--                                                    <a class="dropdown-item"
                                                       href="{{  route('admin.azmoon.quick.reports',['azmoon'=>$azmoon->id,'value'=>'testing'])  }}"
                                                       value="ing">در حال آزمون</a>-->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                       href="{{  route('admin.azmoon.quick.reports',['azmoon'=>$azmoon->id,'value'=>'completed'])  }}">شرکت
                                        کنندگان</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                       href="{{  route('admin.azmoon.quick.reports',['azmoon'=>$azmoon->id,'value'=>'absent'])  }}">غائبین</a>

                                </div>
                            </div>


                            <a href="{{ route('admin.exclusives.index',['id'=>$azmoon]) }}" class="btn btn-info btn-sm"
                               title="تفکیک براساس پایه و کلاس ">
                                <i class="ti-shine"></i>
                                <b>تفکیک</b>
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
                                <h4 class="header-title"> جزئیات آزمون</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <div class="row">
                                    <div class="col-sm-4 text-xs-center text-md-left">
                                        <h4 class="lead">جزئیات </h4>
                                        <div class="table-responsive">
                                            <table class="table ">
                                                <tbody>
                                                <tr>
                                                    <td>نوع آزمون</td>
                                                    <td class="text-xs-right"><b>
                                                            @if($azmoon->azmoon_type == 'normal')
                                                                عادی
                                                            @else
                                                                پیشرفته
                                                            @endif
                                                        </b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>کتاب مربوطه</td>
                                                    <td class="text-xs-right"><b>
                                                            @foreach($azmoon->azmoonBooks as $eachBook)
                                                                {{ $eachBook->book->book_name }},
                                                            @endforeach
                                                        </b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>نام آزمون</td>
                                                    <td class="text-xs-right"><b>{{ $azmoon->azmoon_title ?? '' }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>زمان شروع</td>
                                                    <td class="text-xs-right"><b>{{ $azmoonDate['start']  }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>زمان پایان</td>
                                                    <td class="text-xs-right"><b>{{ $azmoonDate['end'] }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>لینک آزمون</td>
                                                    <td class="text-xs-right">

                                                        <button class="btn btn-outline-info btn-sm"
                                                                onclick="copyToClipboard('#links')">
                                                            <i class="fa fa-copy"></i>
                                                            <span>کپی لینک</span>
                                                        </button>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>هزینه آزمون</td>
                                                    <td class="text-xs-right">
                                                        @if($azmoon->type_payment == 'free')
                                                            <b> ندارد</b>
                                                        @else
                                                            <b> تومان {{ $azmoon->price ?? '' }}</b>
                                                        @endif
                                                        {{ $azmoon->price ?? '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>نوع هزینه</td>
                                                    <td class="text-xs-right">
                                                        <b>{{ $azmoon->type_payment == 'free' ? 'رایگان'  : 'پیش فرض'}} </b>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 text-xs-center text-md-left">
                                        <h4 class="lead">جزئیات </h4>
                                        <div class="table-responsive">
                                            <table class="table ">
                                                <tbody>
                                                <tr>
                                                    <td>همگام سازی آزمون</td>
                                                    <td class="text-xs-right">
                                                        <b>{{ $azmoon->azmoon_sync == 1 ? 'فعال' : 'غیر فعال' }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>مدت زمان تاخیر</td>
                                                    <td class="text-xs-right"><b>
                                                            {{ $azmoon->azmoon_sync_time == null ? 'ندارد' : "$azmoon->azmoon_sync_time دقیقه " }}</b>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>مدت آزمون</td>
                                                    <td class="text-xs-right"><b>{{ $azmoon->azmoon_time ?? '' }}</b>
                                                        دقیقه
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>نوع سوال</td>
                                                    <td class="text-xs-right"><b>
                                                            @if( $soal->type == 'porseshnameh')
                                                                پرسشنامه ای
                                                            @else
                                                                سوال به سوال
                                                            @endif
                                                        </b></td>
                                                </tr>
                                                <tr>
                                                    <td>تعداد سوال</td>
                                                    <td class="text-xs-right"><b>{{ $soal->soal_count ?? '' }}</b> سوال
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>نوع نمایش گزینه ها</td>
                                                    <td class="text-xs-right">
                                                        <b>{{ $soal->answer_type  == 'latin' ? 'A B C D' : '1 2 3 4' }}</b>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 text-xs-center">
                                        <div>
                                            <a class="image-popup-vertical-fit" href="{{ asset($azmoon_cover) }}"
                                               title="کاور آزمون">
                                                <img class="img-fluid img-thumbnail" alt=""
                                                     src="{{ asset($azmoon_cover) }}"
                                                     width="400">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @if($azmoon->azmoon_type == 'normal')
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">مشاهده جزئیات سوالات و آزمون برگزاری </h4>
                                    <p class="card-title-desc">
                                    @if($files->isNotEmpty())
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                <tr>
                                                    <th>عنوان</th>
                                                    <th>تصویر</th>
                                                    <th>فایل</th>
                                                    <th>تنظیمات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($files as $file)
                                                    <tr>
                                                        <td> {{ $file->title }}</td>
                                                        <td><a href="{{ asset($file->image) }}">فایل تصویر</a></td>
                                                        <td>
                                                            <a href="{{ asset($file->pdf_file) }}">فایل pdf</a>
                                                        </td>
                                                        <td>
                                                            <div class="btn btn-group">
                                                                <form
                                                                    action="{{ route('admin.azmoonSoalatFiles.destroy',$file) }}"
                                                                    method="post">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button
                                                                        onclick="return confirm('از حذف فایل مطمئن هستید؟')"
                                                                        type="submit" class="btn btn-danger btn-sm"
                                                                        title="حذف ">
                                                                        <i class="ti-trash"></i>
                                                                        <b>حذف</b>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست فایل آزمون خالی می باشد!
                                        </div>
                                        @endif
                                        </p>
                                </div>
                            </div>
                        </div>

                        @if($soal->type == 'porseshnameh')
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">مشاهده جزئیات سوالات پرسشنامه ای و کلید سوالات </h4>
                                        <p class="card-title-desc">
                                            <a href="{{ route('admin.porseshnamehs.create',['azmoon'=>$azmoon]) }}"
                                               class="btn btn-light btn-rounded"><i class="dripicons-plus mr-1"></i>
                                                <b>افزودن سوالات پرسشنامه</b>
                                            </a>
                                            <a href="{{ route('admin.azmoonSoalatFiles.create',['azmoon'=>$azmoon]) }}"
                                               class="btn btn-light btn-rounded"><i class="dripicons-plus mr-1"></i>
                                                <b>افزودن فایل سوالات</b>
                                            </a>

                                            @if($porseshnames)
                                                <div id="overflowTest">
                                                    <div class="col-12 px-0">
                                                        <div class="box"
                                                             style="background-color: #ffd008;border-radius: 3px">
                                                            <div class="row text-center py-3"
                                                                 style="align-items: center">
                                                                <div class="col">
                                                                    <p class="mb-0">سوال</p>
                                                                 </div>
                                                            <div class="col">
                                                                <p class="mb-0">گزینه 1</p>
                                                            </div>
                                                            <div class="col">
                                                                <p class="mb-0">گزینه 2</p>
                                                            </div>
                                                            <div class="col">
                                                                <p class="mb-0">گزینه 3</p>
                                                            </div>
                                                            <div class="col">
                                                                <p class="mb-0">گزینه 4</p>
                                                            </div>
                                </div>
                            </div>
                </div>

                <?php
                $pi = 1;
                for ($loop = 1;$loop <= $soal->soal_count;$loop++) { ?>
                <div class="col-12 px-0 mt-4">
                    <div class="boxone"
                         style="background-color: pink ;border-radius: 3px">
                        <div class="row text-center py-2 mx-0"
                             style="align-items: center">
                            <div class="col">
                                <p class="mb-0 ">{{ $loop }}</p>
                            </div>
                            <?php for ($loopRadio = 1;$loopRadio <= 4;$loopRadio++) {
                            $radioStr = $loop . "_" . $loopRadio;
                            $checked = null;
                            if (array_key_exists($loop, $correctKeys)) {
                                $st_ans = $correctKeys[$loop];
                                if ($loopRadio == $st_ans) {
                                    $checked = "checked";
                                }
                            }
                            ?>
                            <div class="col">
                                <div class="chiller_cb">
                                    <label for="myCheckbox{{ $radioStr }}">
                                        <input id="myCheckbox{{ $radioStr }}"
                                               type="radio" disabled
                                               name="{{ $loop }}" {{ $checked }}
                                               value="{{ $loopRadio }}">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>


            </div>


            @else
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>توجه!</strong> لیست گزینه سوال خالی می باشد!
                </div>
                @endif
                </p>

        </div>
    </div>
    </div>
    @elseif($soal->type == 'soal_b_soal')
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">مشاهده جزئیات سوالات پرسشنامه ای و کلید سوالات </h4>
                    <p class="card-title-desc">
                        <a href="{{ route('admin.soalbsoals.create',['azmoon'=>$azmoon]) }}"
                           class="btn btn-light btn-rounded"><i class="dripicons-plus mr-1"></i>
                            <b>افزودن سوالات سوال به سوال</b>
                        </a>
                    @if($soalbsoals->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th>فایل</th>
                                    <th>گزینه 1</th>
                                    <th>گزینه 2</th>
                                    <th>گزینه 3</th>
                                    <th>گزینه 4</th>
                                    <th>کلید</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($soalbsoals as $soal)
                                    <tr>
                                        <th scope="row">{{ $soal->azmoonSoalatfile->title }}</th>
                                        <td>{{ $soal->tik_a }}</td>
                                        <td>{{ $soal->tik_b }}</td>
                                        <td>{{ $soal->tik_c }}</td>
                                        <td>{{ $soal->tik_d }}</td>
                                        <td>{{ $soal->key }}</td>
                                        <td>
                                            <div class="btn btn-group">
                                                <form
                                                    action="{{ route('admin.porseshnamehs.destroy',$soal) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="btn-group btn-group-xs">
                                                        <button
                                                            onclick="return confirm('از حذف گزینه سوال مطمئن هستید؟')"
                                                            type="submit"
                                                            class="btn btn-danger btn-sm"
                                                            title="حذف ">
                                                            <i class="ti-trash"></i>
                                                            <b>حذف</b>
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
                    @else
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>توجه!</strong> لیست گزینه سوال خالی می باشد!
                        </div>
                        @endif
                        </p>

                </div>
            </div>
        </div>
        @endif


        @elseif($azmoon->azmoon_type == 'advanced')

        @if($soal->type == 'porseshnameh')
        @include('panel.admin.azmoons.azmoon_types.advanced.porseshnameh')
        @elseif($soal->type == 'soal_b_soal')
        @include('panel.admin.azmoons.azmoon_types.advanced.soal_b_soal')
        @endif
        @endif
        </div>

        </div>
        </div>
        </div>

@endsection
