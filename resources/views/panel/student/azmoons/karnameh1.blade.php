<div class="col-12 px-0">
    <div class="container my-3">
        <div class="box">
            <div class="col-6 col-md-3 mt-3">
                <p>کد کاربر : <span>{{ $user->id }}</span></p>
            </div>
            <div class="col-md-6 d-md-block d-lg-block">
                <div class="btn btn-outline-pink w-100">گروه تیزهوشان علم برتر سالار</div>
            </div>
            <div class="col-6 col-md-3">
                <img src="/assets/karnameh/img/logo-jpg.jpg" class="img-fluid d-block ml-auto"
                     style="width: 100px;height: 70px">
            </div>
        </div>


        <div class="box my-2 justify-content-md-between">
            <div class="col-5 col-md-3 my-1">
                <img src="{{ asset('/assets/karnameh/img/img_401900.png') }}" class="img-fluid"
                     style="width: 90px; height: 90px">
            </div>
            <div class="col-12 col-md-5 col-lg-4 my-1">
                <div class="btn btn-outline-pink"><p>سیستم آزمون:<span class="font-s">عادی(بدون ضریب)</span></p>
                </div>
            </div>
        </div>


        <div class="row my-3 mx-0">
            <div class="col-12 col-md-3 col-lg-2 my-1">
                <p>نام : <span>{{ $user->first_name }}</span></p>
            </div>
            <div class="col-12 col-md-3 col-lg-2 my-1">
                <p>نام خانوادگی : <span>{{ $user->last_name }}</span></p>
            </div>
            <div class="col-12 col-md-3 col-lg-2 my-1">
                <p>پایه : <span>{{ $regClassStudent->educationBase->base_title ?? '' }}</span></p>
            </div>
            <div class="col-12 col-md-3 col-lg-2 my-1">
                <p>کلاس : <span>{{ $regClassStudent->educationClass->class_title ?? '' }}</span></p>
            </div>
            <div class="col-12 col-md-3 col-lg-2 my-1">
                <p>نام آزمون : <span>{{ $azmoon->azmoon_title }}</span></p>
            </div>
            <div class="col-12 col-md-3 col-lg-2 my-1">
                <p>تاریخ آزمون : <span>{{ $azmoonDate['start'] }}</span></p>
            </div>
        </div>


        <div class="container my-5">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>نام آزمون</th>
                    <th>تعداد درست</th>
                    <th>تعداد نادرست</th>
                    <th>بدون جواب</th>
                    <th>نمره درس از</th>
                    <th>درصد</th>
                    <th>حداکثر درصد</th>
                    <th>میانگین درصد</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $azmoon->azmoon_title }}</td>
                    <td>{{ $resCount['correct'] }}</td>
                    <td>{{ $resCount['incorrect'] }}</td>
                    <td>{{ $resCount['empty'] }}</td>
                    <td>   @foreach($azmoon->azmoonBooks as $eachBook)
                            {{ $eachBook->book->nomreh }}
                        @endforeach</td>
                    <td>
                        <?php
                        foreach ($azmoon->azmoonBooks as $eachBook) {
                            $nomrehEachSoal = $eachBook->book->nomreh / $azmoon->soal->soal_count;
                        }
                        $dd = $nomrehEachSoal * $resCount['correct'];
                        $percent = $resCount['correct'] / $azmoon->soal->soal_count * 100;
                        ?>
                        {{ $percent}} %
                    </td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="box justify-content-center">
            <p class="px-2">درصد</p>
            <p class="px-2">حداکثر درصد</p>
            <p class="px-2">میانگین درصد</p>
            <p class="px-2">حداقل درصد</p>
        </div>


        <div class="row justify-content-end my-3">
            <div class="col-7 bor-percent">
            </div>
            <div class="col-3">
                <p class="Percent-height">حداکثر درصد</p>
                <p class="Percent-height pt-5">میانگین درصد</p>
                <p class="Percent-height pt-5 ">حداقل درصد</p>
            </div>
        </div>

        <div class="container pt-4">
            <table class="table table-bordered ">
                <thead>
                <tr>
                    <th>تعداد شرکت کنندگان در آزمون:1</th>
                    <th class="font-weight-bold">تصویر پاسخنامه</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td width="30%">اسمارت</td>
                    <td>
                        <div class="row">
                            @if(! empty($studentAnswers))
                                <?php
                                $ep = true;
                                $soalCount = $soal->soal_count;
                                $soalLoop = 0;

                                /// start first do while loop
                                do{
                                $eachCol = 0;
                                $ep = true;
                                ?>
                                <div class="col-12 col-12 col-md-4">
                                    <?php
                                    /// start second do while loop
                                    do{
                                    $soalLoop++;
                                    $eachCol++;
                                    if ($eachCol >= 10) {
                                        $ep = false;
                                    }
                                    $restxt = "";
                                    ?>
                                    <div class="row text-center py-2 mx-0" style="align-items: center">
                                        <div class="col">
                                            <p class="mb-0 ">{{ $soalLoop }}</p>
                                        </div>
                                        <?php for ($radioLoop = 1;$radioLoop <= 4;$radioLoop++) {
                                        if (array_key_exists($soalLoop, $studentAnswers)) {
                                            $st_ans = $studentAnswers[$soalLoop];
                                            $tc_ans = $correctKeys[$soalLoop];
                                            if ($st_ans == $tc_ans) {
                                                $restxt = "green";
                                            } elseif ($st_ans != $tc_ans) {
                                                $restxt = "green";
                                            }
                                        } ?>
                                        <div class="col">
                                            <div class="chiller_cb">
                                                <label for="myCheckbox{{ $radioLoop }}">
                                                    <input id="myCheckbox{{ $radioLoop }}" type="radio"
                                                           name="{{ $soalLoop }}">
                                                    <?php if ($radioLoop == $st_ans) { ?>
                                                    <span class="{{ $restxt }}"></span>
                                                    <?php }else{ ?>
                                                    <span></span>
                                                    <?php } ?>
                                                </label>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    if ($soalLoop == $soalCount) {
                                        break;
                                    }
                                    }while($ep == true) ?>
                                </div>
                                <?php }while($soalLoop < $soalCount) ?>

                            @endif
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
