<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\RegistrationFee;
use App\RegistrationFeePayment;
use Illuminate\Http\Request;


class RegistrationFeeController extends Controller
{
    public $MerchantID = '3112d616-24f9-11e7-a666-005056a205be'; // elmebartar
    //public $MerchantID = 'd98eecfa-3081-11e8-ac9a-005056a205be'; // elmebartar
    //public $MerchantID = '1698451a-4f34-11ea-82d9-000c295eb8fc'; // barbad
   // public $MerchantID = '4cb16d0d-de95-4204-aa69-6a4e66fc6e1d';
    //public $MerchantID = '51bd7636-baac-4a72-832f-67bf5ee8a9d4';

    public function index()
    {
        $fees = RegistrationFeePayment::query()->where('user_id',auth()->id())->latest()->get();
        return view('panel.student.registrationFees.all',compact('fees'));
    }

    public function show()
    {
        $reg=RegistrationFee::query()->where('base_id',auth()->user()->studentBaseClass->base_id)->first();
        return view('panel.student.registrationFees.show',compact('reg'));
    }

    public function request(Request $request)
    {
        $price = $request['amount'];;
        $Description = 'توضیحات تراکنش تستی'; // Required
        $Email = null; // Optional
        $CallbackURL = url(route('student.registration.fee.verify')); // Required
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
            RegistrationFeePayment::create([
                'user_id'=>auth()->user()->id,
                'amount'=>$request['amount'],
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
        $payment = RegistrationFeePayment::whereResnumber($Authority)->firstOrFail();
        if (request('Status') == 'OK') {
            $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $this->MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $payment->amount,
                ]
            );
            if ($result->Status == 100) {
                $payment->update(['payment'=>1]);
                return redirect(route('student.registration.fee.payment.result'))->with('success','عملیات مورد نظر با موفقیت انجام شد');
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
        $payment=RegistrationFeePayment::query()->where('user_id',auth()->id())->first();
        return view('panel.student.registrationFees.paymentResult',compact('payment'));
    }
}