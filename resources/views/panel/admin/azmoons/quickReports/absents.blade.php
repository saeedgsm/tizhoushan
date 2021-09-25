<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">مشاهده جزئیات آزمون</h4>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>تعداد غائبین : </strong> {{ $countStudents }} <span>نفر</span>
            </div>
            <p class="card-title-desc">
                @include('alert_messages.alerts')

            </p>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>نام - نام خانوادگی</th>
                        <th> کد کاربری</th>
                        <th> پایه</th>
                        <th> کلاس</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(! empty($results))
                        @foreach($results as $result)
                            <?php
                                $user = \App\User::query()->where('id',$result->user_id)->first();
                            ?>
                            <tr>
                                <th>{{ $user->first_name }} {{ $user->last_name }}</th>
                                <th>{{ $user->usercode ?? '' }}</th>
                                <th>{{ $user->studentBaseClass->educationBase->base_title ?? '' }}</th>
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

               // dd($results->links());
                $links = $results->render();
                $patterns = array();
                $patterns[] = '/' . $results->currentPage().'\?page=/';
                $replacements = array();
                $replacements[] = '';
                //dd(url()->current());
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
