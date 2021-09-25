<!doctype html>
<html>

<head>

    <title>کارنامه</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/karnameh/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="/assets/karnameh/css/style.css">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .all-page {

            margin: auto;
        }

        .page {

            margin-bottom: auto;
            padding: 30px 10px 10px 10px;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>

<body>
    <div id="app">
        <div class="container m-4 ">
            <input type='button' value='Print' class='btn' onclick="PrintDoc()" />
        </div>
        <div class="all-page" id="print-view">
            <div class="page">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <h4>گروه تیزهوشان علم برتر سالار</h4>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <h5>کارنامه فردی</h5>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <h5>{{ $azmoon->azmoon_title }}</h5>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <span>کد :</span> <span>{{ $user->id }}</span>
                        </div>
                        <div class="col-lg-3">
                            <p>نام : <span>{{ $user->first_name }}</span></p>
                        </div>
                        <div class="col-lg-3">
                            <p>نام خانوادگی : <span>{{ $user->last_name }}</span></p>
                        </div>
                        <div class="col-lg-3">
                            <p>تاریخ آزمون : <span>{{ $azmoonDate['start'] }}</span></p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 2em">ردیف</th>
                                    <th style="width: 15em">درس</th>
                                    <th style="width: 2em">ضریب</th>
                                    <th style="width: 2em"> درست</th>
                                    <th style="width: 2em"> نادرست</th>
                                    <th style="width: 5ch">بدون جواب</th>
                                    <th style="width: 2em">درصد</th>
                                    <th style="width: 2em">تراز</th>
                                    <th style="width: 5em">حداکثر تراز</th>
                                    <th style="width: 5em">حداقل تراز</th>
                                    <th style="width: 2em">وضعیت</th>
                                    <th style="width: 4em">رتبه در کل</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($azmoon->azmoonBooks as $eachBook)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $eachBook->book->book_name }}</td>
                                        <td>{{ $eachBook->book->zarib }}</td>
                                        <td>{{ $resCount['correct'] }}</td>
                                        <td>{{ $resCount['incorrect'] }}</td>
                                        <td>{{ $resCount['empty'] }}</td>
                                        <td>
                                            <?php $percent = ($resCount['correct'] /
                                            $azmoon->soal->soal_count) * 100; ?>
                                            {{ $percent }} %
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td>مجموع</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>
                                        0
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
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
                        <div class="col-3 mt-3">
                            <p class="Percent-height">حداکثر درصد</p>
                            <p class="Percent-height">میانگین درصد</p>
                            <p class="Percent-height ">حداقل درصد</p>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th>تعداد شرکت کنندگان در آزمون:1</th>
                                    <th class="font-weight-bold">تصویر پاسخنامه</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="20%">

                                    </td>
                                    <td>

                                        <div class="row" dir="ltr">
                                            <?php
                                            $rowControl = 0;
                                            $colC = 0;
                                            ?>
                                            @for ($loop = 1; $loop <= 120; $loop++)
                                                <?php
                                                $rowControl++;
                                                $colC++;
                                                ?>
                                                @if ($colC == 1)
                                                <div
                                                class="col-check-list"> @endif
                                                <div class="row " dir="ltr">
                                                    <div class="cols-number">
                                                        <div class="check-number">{{ convertNumbers($loop) }}</div>
                                                    </div>
                                                    @for ($radioLoop = 1; $radioLoop <= 4; $radioLoop++)
                                                        <?php
                                                        $restxt = 'is-empty-check';
                                                        $q = true;
                                                        if (array_key_exists($loop, $studentAnswers)) {
                                                        $st_ans = $studentAnswers[$loop];
                                                        $tc_ans = $correctKeys[$loop];
                                                        if ($st_ans == '') {
                                                        $restxt = 'is-empty-check';
                                                        } else {
                                                        if ($st_ans == $tc_ans) {
                                                        $restxt = 'is-correct-checked';
                                                        } elseif ($st_ans != $tc_ans) {
                                                        $restxt = 'is-false-checked';
                                                        $q = false;
                                                        }
                                                        }
                                                        /* if ($st_ans == $tc_ans) {
                                                        $restxt = "is-correct-checked";
                                                        } elseif ($st_ans != $tc_ans) {
                                                        $restxt = "is-false-checked";
                                                        }elseif ($st_ans == '') {
                                                        $restxt = "is-empty-check";
                                                        } */
                                                        }
                                                        ?>
                                                        <div class="cols">
                                                            <?php if ($radioLoop == $st_ans) { ?>
                                                            <div class="{{ $restxt }}"></div>
                                                            <?php } elseif ($q == false and $radioLoop ==
                                                            $tc_ans) { ?>
                                                            <div class="is-correct-check"></div>
                                                            <?php } else { ?>
                                                            <div class="is-empty-check"></div>
                                                            <?php }
                                                            // if ($q==false) { if ($radioLoop == $tc_ans) {
                                                            ?>
                                                        </div>
                                                    @endfor
                                                    {{-- <div class="cols">
                                        <div class="is-empty-check"></div>
                                    </div>
                                    <div class="cols">
                                        <div class="is-false-checked "></div>
                                    </div>
                                    <div class="cols">
                                        <div class="is-correct-check"></div>
                                    </div>
                                    <div class="cols">
                                        <div class="is-correct-checked"></div>
                                    </div> --}}
                                                </div>


                                                @if ($rowControl == 10)
                                                    <div class="height-space"></div>
                                                    <?php $rowControl = 0; ?>
                                                @endif
                                                @if ($colC == 30)
                                                <?php $colC = 0; ?>
                                        </div>
                                        @endif

                                        @endfor

                    </div>

                    </td>
                    </tr>
                    </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <img :src="output">

    </div>
    <!--javascript-->
    <script src="/assets/karnameh/js/jquery-3.3.1.js"></script>
    <script src="/assets/karnameh/js/bootstrap.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script> --}}


    <script src="{{ asset('js/dom-to-image.js') }}"></script>
    <script>
        function renderCheckList(params) {

            let view_root = document.getElementById("root-check-list");
            /* let elColMd3 = createHtmlTags('div','col-md-3');
             let check_list_10 = createHtmlTags('div','check-list-10');
             let row = createHtmlTags('div','row');
             let cols_number = createHtmlTags('div','cols-number');
             let check_number = createHtmlTags('div','check-number');
             cols_number.appendChild(check_number);*/
            let elColMd3 = null;
            let rowControl = 1;
            let checkList = 1;
            for (let loop = 1; loop <= 120; loop++) {
                rowControl++;
                checkList++;
                let row = createHtmlTags('div', 'row');
                let cols_number = createHtmlTags('div', 'cols-number');
                cols_number.innerText = loop;
                row.appendChild(cols_number);
                for (let index = 0; index < 4; index++) {
                    let check_point = createHtmlTags('div', 'cols');
                    cols_number.insertAdjacentHTML("afterend", check_point);


                }
                console.log(row);

                if (loop === 1 || loop === 31 || loop === 61 || loop === 91) {
                    elColMd3 = createHtmlTags('div', 'col-md-3');
                    elColMd3.innerText = 12;
                    view_root.appendChild(elColMd3);
                }

                if (checkList === 1 || checkList === 11 || checkList === 21) {
                    checkList10 = createHtmlTags('div', 'check-list-10');
                    checkList = 1;
                    elColMd3.appendChild(checkList10);
                }


                checkList10.appendChild(row)





                /*  elColMd3.appendChild(check_list_10);
                  check_list_10.appendChild(row);
                  check_number.innerHTML = loop;
                  row.appendChild(cols_number);*/


            }

            console.log(view_root);
        }

        function createHtmlTags(elementName, className, idName) {

            let el = document.createElement(elementName);
            if (className != null)
                el.classList.add(className);
            if (idName != null)
                el.setAttribute('id', idName);
            return el;
        }


        function PrintDoc() {
            domtoimage.toJpeg(document.getElementById('print-view'))
                .then(function(dataUrl) {
                    var link = document.createElement('a');
                    link.download = 'my-image-name.jpeg';
                    link.href = dataUrl;
                    link.click();
                });
        }
    </script>

</body>

</html>
