<?php


namespace App\Http\Controllers\Student;


use App\Http\Controllers\Controller;
use App\TariffBase;
use App\TariffBasePayment;
use Illuminate\Http\Request;

class TariffBaseController extends Controller
{
    public $MerchantID = '3112d616-24f9-11e7-a666-005056a205be'; // elmebartar

    public function index()
    {
        $payments = TariffBasePayment::query()->where('user_id',auth()->id())->latest()->get();
        return view('panel.student.tariffBases.all',compact('payments'));
    }

    public function show()
    {
        $BC = auth()->user()->studentBaseClass()->first();
        $tariffs = TariffBase::query()->where('tariff_active',1)->get();
        $ables =[];
        foreach ($tariffs as $tariff) {
            $baseIds = explode(",",$tariff->tariff_bases);
            foreach ($baseIds as $baseId){
                if ($baseId == $BC->base_id){
                    $ables[]=$tariff;
                }
            }
        }
        return view('panel.student.tariffBases.show',compact('ables'));
    }

    public function request(Request $request)
    {
        //return $request->all();
        $tariff = TariffBase::query()->where('id',$request['tariff_id'])->first();
        $price = $tariff->tariff_amount;
        $Description = $tariff->tariff_label; // Required
        $Email = null; // Optional
        $CallbackURL = url(route('student.tariff.bases.verify')); // Required
        $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        $result = $client->PaymentRequest(
            [
                'MerchantID' => $this->MerchantID,
                'Amount' => $price,
                'Description' => $Description,
                'Email' => $Email,
                'CallbackURL' => $CallbackURL,
            ]
        );
        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {
            TariffBasePayment::create([
                'tariff_id'=>$tariff->id,
                'user_id'=>auth()->user()->id,
                'amount'=>$price,
                'resnumber' => $result->Authority,
            ]);
            return redirect('https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
        } else {
            echo 'ERR: ' . $result->Status;
        }
        /*$zp = new zarinpal();
        $ZarinGate 		= false;
        $SandBox 		= false;
        $result = $zp->request($this->MerchantID,$request['amount']
            ,$request['desc'],'t@s.com',$request['phone'],
            route('student.registration.fee.verify'),$SandBox,$ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100)
        {
            RegistrationFeePayment::create([
                'user_id'=>auth()->user()->id,
                'amount'=>$request['amount'],
                'resnumber' => $result->Authority,
            ]);
            // Success and redirect to pay
            $zp->redirect($result["StartPay"]);
        } else {
            // error
            echo "خطا در ایجاد تراکنش";
            echo "<br />کد خطا : ". $result["Status"];
            echo "<br />تفسیر و علت خطا : ". $result["Message"];
        }*/
        //dd($result);
        //return $request->all();
    }

    public function verify(Request $request)
    {
        $Authority = request('Authority');
        $payment = TariffBasePayment::whereResnumber($Authority)->firstOrFail();
        if (request('Status') == 'OK') {
            $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
            $result = $client->PaymentVerification([
                    'MerchantID' => $this->MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $payment->amount,
                ]);
            if ($result->Status == 100) {
                $payment->update(['payment'=>1]);
                return redirect(route('student.tariff.bases.payment.result'))->with('success','عملیات مورد نظر با موفقیت انجام شد');
            } else {
                echo 'Transaction failed. Status:'.$result->Status;
            }
        } else {
            return redirect(route('error.page.canceled'));
            // echo 'Transaction canceled by user';
        }

    }

    public function paymentResult()
    {
        $payment=TariffBasePayment::query()->where('user_id',auth()->id())->first();
        return view('panel.student.registrationFees.paymentResult',compact('payment'));
    }

}