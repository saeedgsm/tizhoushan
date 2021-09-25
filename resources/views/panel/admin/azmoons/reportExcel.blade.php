<table>
    <tr><th>گزارش تحلیلی آزمون</th></tr>
    <tr>
        <th>پایه تحصیلی</th>
        <td>{{ $baseNames }}</td>
    </tr>
    <tr>
        <th>دوره</th>
        <td>-</td>
    </tr>
    <tr>
        <th>کتاب</th>
        <td>{{ $book }}</td>
    </tr>
    <tr>
        <th>آزمون</th>
        <td>{{ $azmoon_title }}</td>
    </tr>
    <tr>
        <th>زمان آزمون</th>
        <td>{{ $azmoon_time }} دقیقه</td>
    </tr>
    <tr>
        <th>تعداد سوال</th>
        <td>{{ $soal_count }}  عدد</td>
    </tr>
    <tr>
        <th>هزینه آزمون</th>
        <td>{{ $payment }}  تومان</td>
    </tr>
    <tr>
        <th></th>
    </tr>
    <thead>
    <tr>
        <th>ردیف</th>
        <th>کد کاربر</th>
        <th>پایه آموزشی</th>
        <th>کلاس آموزشی</th>
        <th>نام</th>
        <th>نام خانوادگی</th>
        <th>رتبه کل در آزمون</th>
        <th>رتبه کل در کلاس</th>
        <th>زمان اجرای آزمون</th>
        <th>مدت زمان آزمون</th>
        <th>تعداد درست</th>
        <th>تعداد نادرست</th>
        <th>تعداد نزده</th>
        <th>گزینه های درست</th>
        <th>گزینه های نادرست</th>
        <th>درصد جواب دهی</th>
        <th>درصد جواب بانمره منفی</th>
        <th>درصد موثر نمره منفی</th>
        <th>نمره</th>
        <th>مدال طلا</th>
        <th>مدال نقره</th>
        <th>مدال برنز</th>
        <th>معدل دوره</th>
        <th>نمره از 300</th>
        <th>مدال های دریافتی</th>
        <th>امتیاز آزمون</th>
        <th>امتیاز دوره</th>
        <th>امتیاز باشگاه</th>
        <th>امتیاز تشویقی</th>
        <th>امتیاز کل</th>
        <th>رتبه امتیاز کل</th>
        <th>رتبه امتیاز کل در کلاس</th>
    </tr>
    </thead>
    <tbody>
    <?php $row=0; ?>
    @foreach($azmoon_results as $result)
        <?php
        $moadel = round($result->correct_count / $soal_count * 100);
        ?>
        <tr>
            <td>{{ ++$row }}</td>
            <td>{{ $result->user->usercode }}</td>
            <td>{{ $result->user->studentBaseClass->educationBase->base_title ?? 'نامشخص' }}</td>
            <td>{{ $result->user->studentBaseClass->educationClass->class_title ?? 'نامشخص' }}</td>
            <td>{{ $result->user->first_name }}</td>
            <td>{{ $result->user->last_name }}</td>
            <td>0</td>
            <td>0</td>
            <td>{{ convertNumbers(Verta::instance($result->start_date)->format('H:i Y/m/d ')) }}</td>
            <td>{{ $result->azmoon->azmoon_time }}</td>
            <td>{{ $result->correct_count }}</td>
            <td>{{ $result->wrong_count }}</td>
            <td>{{ $result->not_answer_count }}</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>{{ $moadel }}</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
    @endforeach
    </tbody>
</table>
