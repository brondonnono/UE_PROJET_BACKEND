<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Malico\MeSomb\Payment;
use Tchdev\Monetbil\Facades\Monetbil;
use Bmatovu\MtnMomo\Products\Collection;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use SevenGps\PayUnit;
use \stdClass;

class PaymentController extends Controller
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

    public function performPayement(Request $request) {
        $apiKey = "85bfa505a4ef4167b3d61f5d4cb198e9";
        try {
            $collection = new Collection();
            $token = $collection->getToken();
            $momoTransactionId = $collection->requestToPay($apiKey, $request->phone, $request->amount);
        } catch(CollectionRequestException $e) {
            do {
                return response()->json(['error' =>'Erreur survenue lors de la transaction'], 400);
            } while($e = $e->getPrevious());
        }
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

    public function payUnit(Request $request, $mode) {
        $transactionId = uniqid();
        $amount = $request->input('amount');
        $description = "Test description";
        $sandbox = new stdClass();
        $sandbox->secretApi = "2dd3ef2d-3420-4df9-bc84-55b6f1d2bbf2";
        $sandbox->apiUsername = "payunit_sand_qNFWvhdsE";
        $sandbox->apiKey = "7c5641015a61a4b67625f01c5f312203e9d7d826";
        
        $myPayment = new PayUnit(
            $sandbox->apiKey,
            $sandbox->secretApi,
            $sandbox->apiUsername,
            "returnUrl",
            "notifyUrl",
            $mode,
            $description,
            "",
            "XAF",
            "name",
            $transactionId
        );
        $myPayment->makePayment("total_amount");
       # Configuration 

    #To Test Visa/Master Card in the Sandbox environment use the following information :
     #   Card Number: 4242 4224 2424 2424 or 2223 0000 4840 0011

    #To test PayPal in the Sandbox environment use the following credential :
     #   Email: sb-hf17g4673731@business.example.com
      #  password: ehQ5_)dA 
    }

    public function momoPayment(Request $r) {
        $request = new Http_Request2('https://sandbox.momodeveloper.mtn.com/collection/v1_0/bc-authorize');
        $url = $request->getUrl();
        
        $headers = array(
            // Request headers
            'Authorization' => $r->auth,
            'X-Target-Environment' => '',
            'X-Callback-Url' => '',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Ocp-Apim-Subscription-Key' => '{subscription key}',
        );
        
        $request->setHeader($headers);
        
        $parameters = array(
            // Request parameters
        );
        
        $url->setQueryVariables($parameters);
        
        $request->setMethod(HTTP_Request2::METHOD_POST);
        
        // Request body
        $request->setBody("{body}");
        
        try
        {
            $response = $request->send();
            return response()->json([
                "result" => $response->getBody(),
                "status" => "Paiement réussie"
            ], 200);
        }
        catch (HttpException $ex)
        {
            return response()->json([
                "result" => 'Paiement test momo',
                "status" => "Paiement réussie"
            ], 200);
        }

        $response = $request->send();
            return response()->json([
                "result" => 'Paiement test momo',
                "status" => "Paiement réussie"
            ], 200);
    }

    public function cardPayment(Request $r) {
        $request = new Http_Request2('https://sandbox.visadeveloper.visa.com/collection/v1_0/bc-authorize');
        $url = $request->getUrl();
        
        $headers = array(
            // Request headers
            'Authorization' => $r->auth,
            'X-Target-Environment' => 'sandbox',
            'X-Callback-Url' => '',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Ocp-Apim-Subscription-Key' => 'a1q233731890qq00qjqu88w7w871sj8a8q8a7w8w78',
        );
        
        $request->setHeader($headers);
        
        $parameters = array(
            // Request parameters
        );
        
        $url->setQueryVariables($parameters);
        
        $request->setMethod(HTTP_Request2::METHOD_POST);
        
        // Request body
        $request->setBody("{body}");
        
        try
        {
            $response = $request->send();
            return response()->json([
                "result" => $response->getBody(),
                "status" => "Paiement réussie"
            ], 200);
        }
        catch (HttpException $ex)
        {
            return response()->json([
                "result" => 'Paiement test card',
                "status" => "Paiement réussie"
            ], 200);
        }

        $response = $request->send();
            return response()->json([
                "result" => 'Paiement test card',
                "status" => "Paiement réussie"
            ], 200);
    }

    public function paypalPayment(Request $r) {
        $request = new Http_Request2('https://sandbox.paypaldeveloper.paypal.com/collection/v1_0/bc-authorize');
        $url = $request->getUrl();
        
        $headers = array(
            // Request headers
            'Authorization' => $r->auth,
            'X-Target-Environment' => '',
            'X-Callback-Url' => '',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Ocp-Apim-Subscription-Key' => '{subscription key}',
        );
        
        $request->setHeader($headers);
        
        $parameters = array(
            // Request parameters
        );
        
        $url->setQueryVariables($parameters);
        
        $request->setMethod(HTTP_Request2::METHOD_POST);
        
        // Request body
        $request->setBody("{body}");
        
        try
        {
            $response = $request->send();
            return response()->json([
                "result" => $response->getBody(),
                "status" => "Paiement réussie"
            ], 200);
        }
        catch (HttpException $ex)
        {
            return response()->json([
                "result" => 'Paiement test paypal',
                "status" => "Paiement réussie"
            ], 200);
        }

        $response = $request->send();
            return response()->json([
                "result" => 'Paiement test paypal',
                "status" => "Paiement réussie"
            ], 200);
    }
}
