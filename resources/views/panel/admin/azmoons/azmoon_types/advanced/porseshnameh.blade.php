<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">مشاهده جزئیات سوالات پرسشنامه ای و کلید سوالات </h4>
            <p class="card-title-desc">

            @if($advancedPorseshnamehs->isEmpty())

                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>توجه!</strong> لیست گزینه سوال خالی می باشد!
                </div>
            @endif

            <hr>
            @if(! empty($soalBooks))
                  <form action="{{ route('admin.insert.advance.soal') }}" method="post">
                      @csrf
                      @method('POST')
                      <input type="hidden" name="azmoon_id" value="{{ $azmoon->id }}">
                     <div class="row">
                         <div class="col-lg-4">
                            <div class="form-group">
                                <label for="book_id">کتاب مربوطه</label>
                                <select required name="book_id" id="book_id" class="form-control">
                                    <option value="">لطفا انتخا کنید!</option>
                                    @foreach($soalBooks as $soalBook)
                                        <option value="{{ $soalBook->id }}">{{ $soalBook->book_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                         </div>
                         <div class="col-lg-4">
                             <div class="form-group">
                                 <label for="soal_count">تعداد سوال</label>
                                 <input required id="soal_count" type="number" name="soal_count" class="form-control">
                             </div>
                         </div>
                         <div class="col-lg-12">
                             <div class="form-group ">
                                 <button type="submit" class="btn btn-outline-success">ایجاد فرم سوال</button>
                             </div>
                         </div>
                     </div>
                  </form>
            @endif
            @if($advancedPorseshnamehs->isNotEmpty())
                <?php $newName=1; ?>
                @foreach($advancedPorseshnamehs as $advancedPorseshnameh)
                    <div class="mt-5">
                        <h4>{{ $advancedPorseshnameh->book->book_name }}</h4>
                        <hr>
                        <div id="overflowTest">
                            <div class="col-12 px-0">
                                <div class="box"
                                     style="background-color: #ffd008;border-radius: 3px">
                                    <div class="row text-center py-3" style="align-items: center">
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
                            $newName++;

                            $keyExp=explode(',',$advancedPorseshnameh->correct_key);

                            $offerArray=array();

                            foreach ($keyExp as $item){
                                $arA=explode(':',$item);
                                $offerArray[$arA[0]] = $arA[1];
                            }
                            $correctKeys=$offerArray;

                            $pi = 1;
                            for ($loop = 1;$loop <= $advancedPorseshnameh->number_of_question;$loop++) { ?>
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
                                                <label for="myCheckbox{{ $newName }}{{ $radioStr }}">
                                                    <input id="myCheckbox{{ $newName }}{{ $radioStr }}"
                                                           type="radio" disabled
                                                           name="{{ $newName }}{{ $loop }}" {{ $checked }}
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
                    </div>

                @endforeach

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

<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">مشاهده جزئیات سوالات پرسشنامه ای و کلید سوالات </h4>
            <p class="card-title-desc"></p>
            <?php
            $poreshnamehFiles = \App\AzmoonAdvancedFile::query()->where('azmoon_id',$azmoon->id)->get();
            ?>
            @if($poreshnamehFiles->isNotEmpty())
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th>کتاب</th>
                            <th>عنوان</th>
                            <th>تصویر</th>
                            <th>فایل</th>
                            <th>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($poreshnamehFiles as $file)
                            <tr>
                                <td> {{ $file->book->book_name }}</td>
                                <td> {{ $file->title }}</td>
                                <td><a href="{{ asset($file->image) }}">فایل تصویر</a></td>
                                <td>
                                    <a href="{{ asset($file->pdf_file) }}">فایل pdf</a>
                                </td>
                                <td>
                                    <div class="btn btn-group">
                                        <form
                                            action="{{ route('admin.advanced.porseshname.file.destroy',$file) }}"
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
        </div>
    </div>
</div>
