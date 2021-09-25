<?php

namespace App\Exports;

use App\Azmoon;
use App\AzmoonResult;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AzmoonReport implements  WithEvents, FromView
{
    use Exportable;

    public function __construct(Azmoon $azmoon)
    {
        $this->azmoon = $azmoon;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        $az = Azmoon::where('id',$this->azmoon->id)->get();
        return$results = AzmoonResult::where('azmoon_id',$this->azmoon->id)->get();

        return $az;
    }*/

    /*public function headings(): array
    {
        $book = $this->azmoon->book()->first();
        $bases = $book->bases;
        foreach ($bases as $base){
            $li[] = $base->base_title;
        }
        $baseNames = implode(", ",$li);

        $soal = $this->azmoon->soal()->first();
        $payment=null;
        if ($this->azmoon->type_payment == 'free'){
            $payment="رایگان";
        }else{
            $payment= $this->azmoon->price .= ' تومان';
        }

        $results = AzmoonResult::where('azmoon_id',$this->azmoon->id)->get();

        return [
            ['گزارش تحلیلی آزمون'],
            ['پایه تحصیلی ', $baseNames],
            ['دوره  ', '-'],
            ['کتاب  ', $book->book_name],
            ['آزمون  ', $this->azmoon->azmoon_title],
            ['زمان آزمون  ', $this->azmoon->azmoon_time .= " دقیقه "],
            ['تعداد سوال  ', $soal->soal_count],
            ['هزینه آزمون  ', $payment],
            [' '],
            [
                '#',
                'کد کاربر',
                'کلاس آموزشی',
                'نام',
                'نام خانوادگی',
                'رتبه کل در آزمون',
                'رتبه کل در کلاس',
                'زمان اجرای آزمون',
                'مدت زمان آزمون',
                'تعداد درست',
                'تعداد نادرست',
                'تعداد نزده',
                'گزینه های درست',
                'گزینه های نادرست',
                'درصد جواب دهی',
                'درصد جواب بانمره منفی',
                'درصد موثر نمره منفی',
                'معدل',
                'مدال طلا',
                'مدال نقره',
                'مدال برنز',
                'معدل دوره',
                'نمره از 300',
                'مدال های دریافتی',
                'امتیاز آزمون',
                'امتیاز دوره',
                'امتیاز باشگاه',
                'امتیاز تشویقی',
                'امتیاز کل',
                'رتبه امتیاز کل',
                'رتبه امتیاز کل در کلاس',
            ],
        ];
    }*/

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }
    /*public function collection()
    {
        $book = $this->azmoon->book()->first();
        $bases = $book->bases;
        foreach ($bases as $base){
            $li[] = $base->base_title;
        }
        $baseNames = implode(", ",$li);
        return $baseNames;
        return view('panel.admin.azmoons.reportExcel',[
            'baseNames'=>$baseNames
        ]);
    }*/
    public function view(): View
    {
        $soal = $this->azmoon->soal()->first();

        $azmoonBooks =$this->azmoon->azmoonBooks()->get();

        foreach ($azmoonBooks as $azmoonBook){
            $bases = $azmoonBook->book->bases;
            foreach ($bases as $base){
                $bookName = $azmoonBook->book->book_name;
                $li[] = $base->base_title;
                $nomreh_soal = $azmoonBook->book->nomreh / $soal->soal_count;
            }
        }

        $baseNames = implode(", ",$li);

        $payment=null;
        if ($this->azmoon->type_payment == 'free'){
            $payment="رایگان";
        }else{
            $payment= $this->azmoon->price .= ' تومان';
        }
        $azmoonResults = $this->azmoon->AzmoonResults()->get();



        return view('panel.admin.azmoons.reportExcel',[
            'baseNames'=>$baseNames,
            'book'=>$bookName,
            'azmoon_title'=>$this->azmoon->azmoon_title,
            'azmoon_time'=>$this->azmoon->azmoon_time,
            'soal_count'=>$soal->soal_count,
            'payment'=>$payment,
            'nomreh_soal' =>$nomreh_soal,
            'azmoon_results'=>$azmoonResults,
            ]);
    }
}
