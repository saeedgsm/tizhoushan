<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">مشاهده جزئیات آزمون</h4>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>تعداد شرکت کنندگان : </strong> {{ $countStudents }} <span>نفر</span>
            </div>
            <p class="card-title-desc">
                @include('alert_messages.alerts')

            </p>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>تاریخ شروع</th>
                        <th>کد </th>
                        <th>نام - نام خانوادگی</th>
                        <th> پایه</th>
                        <th> کلاس</th>
                        <th> نمره از 300</th>
                        <th> درست</th>
                        <th> نادرست</th>
                        <th> نزده</th>
                        <th> وضعیت آزمون</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($results->isNotEmpty())
                        @foreach($results as $result)
                            <tr>
                                <td>{{ convertNumbers(new Verta($result->created_at)) }}</td>
                                <td>( {{ $result->user->usercode ?? ''}} ) </td>
                                <td>{{ $result->user->first_name ?? '' }} {{ $result->user->last_name ?? '' }}</td>
                                <td>{{ $result->user->studentBaseClass->educationBase->base_title ?? '' }} </td>
                                <td>{{ $result->user->studentBaseClass->class_title ?? 'نامشخص' }} </td>
                                <td>
                                    <?php
                                    foreach($azmoon->azmoonBooks as $eachBook){
                                        $nomrehEachSoal =  $eachBook->book->nomreh  / $azmoon->soal->soal_count;
                                    }
                                    $dd =$nomrehEachSoal *  $result->correct_count;
                                    ?>
                                    {{ $dd }} %
                                </td>
                                <td>{{ $result->correct_count }}</td>
                                <td>{{ $result->wrong_count }}</td>
                                <td>{{ $result->not_answer_count }}</td>
                                <td>
                                    <a href="{{ route('admin.azmoon.result.reset.user',$result) }}" class="btn btn-danger">ریست </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>توجه!</strong> لیست گزارش آزمون خالی می باشد!
                        </div>
                    @endif
                    </tbody>
                </table>
                <?php
                $links = $results->render();
                $patterns = array();
                $patterns[] = '/' . $results->currentPage().'\?page=/';
                $replacements = array();
                $replacements[] = '';
                echo preg_replace($patterns, $replacements, $links);
                ?>
                <a href="{{ route('admin.azmoons.show',$azmoon) }}" class="btn btn-outline-info">
                    <i class="dripicons dripicons-arrow-left"></i>
                    برگشت
                </a>
            </div>
        </div>
    </div>
</div>
