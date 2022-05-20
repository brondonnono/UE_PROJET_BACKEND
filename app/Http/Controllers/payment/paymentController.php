<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Malico\MeSomb\Payment;
use Tchdev\Monetbil\Facades\Monetbil;

class paymentController extends Controller
{

    public function paymentProcessing($data) {

        if(!isset($data->number)) {
            return response()->json(["message" => "Le numéro de téléphone est obligatoire"], 400);
        } else if (!isset($data->amount)) {
            return response()->json(["message" => "Le montant est obligatoire"], 400);
        }

        if (isset($data->amount) and $data->amount < 50) {
            return response()->json(["message" => "Le montant doit être au moins de 50"], 400);
        }

        $debug_payment = "test";

        if ($debug_payment == "dev") {
            $this->confirmOrder($data);
        } else {
            $this->testPayment($data);
        }
    }
    
    public function confirmOrder($data)
    {
        $request = new Payment('+237'.$data->number, $data->amount);

        $payment = $request->pay();

        if($payment->success) {
            return response()->json([
                "success" => "Paiement effectué avec succès",
                "from" => "237".$data->number,
                "details" => $payment
            ], 200);
            // Fire some event,Pay someone, Alert user
        } else {
            return response()->json([
                "failed" => "Echec du Paiement",
                "from" => "237".$number,
                "details" => $payment,
                "Transactions details" => $payment->transactions
            ], 400);
            // fire some event, redirect to error page
        }

        // get Transactions details $payment->transactions
    }

    public function testPayment($data) {
        
    }


    public function monetBilPaymentFunction_() {

        // Setup Monetbil arguments
        $monetbil_args = array(
            'amount' => 10,
            'phone' => '+237655429550',
            'locale' => 'en', // Display language fr or en
            'country' => '',
            'currency' => 'XAF',
            'item_ref' => '1',
            'payment_ref' => md5(uniqid()),
            'user' => 1,
            'first_name' => 'NONO',
            'last_name' => 'BRONDON',
            'email' => 'brondonnono3@email.com',
            'return_url' => '',
            'notify_url' => '',
            'logo' => ''
        );

        // This example show payment url
        return Monetbil::url($monetbil_args);
    }
}
