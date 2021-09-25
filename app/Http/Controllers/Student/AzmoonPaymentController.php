<?php

namespace App\Http\Controllers\Student;

use App\Azmoon;
use App\AzmoonPayment;
use App\core\gateway\zarinpal\zarinpal;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use SoapClient;

class AzmoonPaymentController extends Controller
{
    public function preview(Request $request)
    {
        $azmoon = Azmoon::query()->where('id', $request['azmoon_id'])->first();
        if ($azmoon->type_payment != 'cash') {
            return redirect(url()->previous())->with('warning', 'مسیر اشتباهی است');
        }

        $azmoonDate['start'] = convertNumbers(Verta::instance($azmoon->azmoon_start)->format('H:i Y/m/d '));
        $azmoonDate['end'] = convertNumbers(Verta::instance($azmoon->azmoon_end)->format('H:i Y/m/d '));

        return view('panel.student.azmoonPayments.preview', compact('azmoon', 'azmoonDate'));
    }

    public function request(Request $request)
    {
        $MerchantID = env('ZP_MID');
        $Amount = $request['amount'];
        $Description = "تراکنش زرین پال";
        $Email = "";
        $Mobile = auth()->user()->phone;
        $CallbackURL = route('student.azmoon.payment.verify');
        $ZarinGate = false;
        $SandBox = false;

        $zarin_client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $zarin_client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => '',
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );

        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {

            auth()->user()->azmoonPayments()->create([
                'amount' => $Amount,
                'resnumber' => $result->Authority,
                'azmoon_id' => $request['azmoon_id'],
                'gateway' => $request['gateway'],
            ]);
            return redirect('https://sandbox.zarinpal.com/pg/StartPay/' . $result->Authority);


        } else {

            return response()->json(['status' => false, 'message' => 'خطای درگاه بانک']);
        }


        die;

    }

    public function verify(Request $request)
    {
        $payment = AzmoonPayment::query()->where('resnumber', $request['Authority'])->first();
        $azmoon = $payment->azmoon;

        if ($request['Status'] == "OK") {
            $payment->update([
                'status' => 1,
                'payment_date'=>Carbon::now()
            ]);
        }
        $azmoonDate['start'] = convertNumbers(Verta::instance($azmoon->azmoon_start)->format('H:i Y/m/d '));
        $azmoonDate['end'] = convertNumbers(Verta::instance($azmoon->azmoon_end)->format('H:i Y/m/d '));
        return view('panel.student.azmoonPayments.result', compact('payment', 'azmoon', 'request','azmoonDate'));
        return $request->all();
    }
}
