<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">مشاهده جزئیات آزمون</h4>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>توجه!</strong> لیست گزارش آزمون طی 24 ساعت گذشته می باشد!
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
                                <td>( {{ $result->user->usercode ?? '' }} ) </td>
                                <td>{{ $result->user->first_name ?? '' }} {{ $result->user->last_name ?? '' }}</td>
                                <td>{{ $result->user->studentBaseClass->class_title ?? 'نامشخص' }} </td>
                                <td>0</td>
                                <td>{{ $result->correct_count }}</td>
                                <td>{{ $result->wrong_count }}</td>
                                <td>{{ $result->not_answer_count }}</td>
                                <td>0</td>
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
            </div>
        </div>
    </div>
</div>
