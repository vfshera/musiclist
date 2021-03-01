<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Safaricom\Mpesa\Mpesa;

class PaymentsController extends Controller
{


    public function stkpush(Request $request)
    {
       $link = '';

        $details = $request->validate([
            'phone' => 'required|string',
            'amount' => 'required|string',
            'description' => 'required|string'
        ]);


        $mpesa = new Mpesa();
        $BusinessShortCode = env('MPESA_TILL_NUMBER');
        $LipaNaMpesaPasskey = env('MPESA_PASSKEY');
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = $details['amount'];
        $PartyA = $details['phone'];
        $PartyB = env('MPESA_TILL_NUMBER');
        $PhoneNumber = $details['phone'];
        $CallBackURL = $link.'/result';
        $AccountReference = env('MPESA_TILL_NAME');
        $TransactionDesc = $details['description'];
        $Remarks = 'Sample payment';
        $stkPushSimulation = $mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);

        return $stkPushSimulation;
    }

    /**
     * safaricom quetimeout error occurs here
     *
     * this route is hit on timeout error
     *
     *
     */

    public function qtimeout()
    {
        $mpesa = new Mpesa();
        $callbackData = $mpesa->getDataFromCallback();
        dd($callbackData);
    }
    /**
     * Client to business requests occur here  occurs here

     */
    public function c2b()
    {

        $mpesa = new Mpesa();
        $ShortCode = env('MPESA_TILL_NUMBER');
        $CommandID = 'CustomerPayBillOnline';
        $Amount = 10000;
        $Msisdn = 254708374149;
        $BillRefNumber = 'account';

        $b2bTransaction = $mpesa->c2b($ShortCode, $CommandID, $Amount, $Msisdn, $BillRefNumber);

        return $b2bTransaction;
    }

    /**
     * the confirmation url of c2b transaction occurs here
     *
     *
     */
    public function confirmmpesa()
    {

        $mpesa = new Mpesa();

        $callbackData = $mpesa->getDataFromCallback();
        header("Content-Type:application/json");
        $resp = '{"ResultCode":0,"ResultDesc":"Confirmation recieved successfully"}';
        $mpesa_response = file_get_contents("php://input");
        // $mpesa_response="sample";


        Storage::put('confirm.txt', $callbackData);
        $callbackData = $mpesa->finishTransaction();
        Storage::put('finish.txt', $callbackData);

        echo $resp;
    }

    /**
     * The validatiour request of c2b transactions occur here
     *
     *
     */
    public function validatempesa()
    {
        $mpesa = new Mpesa();

        $callbackData = $mpesa->getDataFromCallback();
        header("Content-Type:application/json");
        $resp = '{"ResultCode":0,"ResultDesc":"Validation passed successfully"}';
        $mpesa_response = file_get_contents("php://input");
        // $mpesa_response="sample";

        Storage::put('validate.txt', $callbackData);


        echo $resp;
    }
    /**
     * The  result callbacl of transaction is here
     *
     *
     */
    public function result()
    {

        $mpesa = new Mpesa();

        $callbackData = $mpesa->getDataFromCallback();
        dd($callbackData);
    }
    /**
     * The register url is here
     */

    public function register_urls()
    {

        try {
            $environment = env("MPESA_ENV");
        } catch (\Throwable $th) {
            $environment = env("MPESA_ENV");
        }
        // return $environment;

        if ($environment == "live") {
            $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
            $token = Mpesa::generateLiveToken();
        } else {
            $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
            $token = Mpesa::generateSandBoxToken();
        }





        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token)); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => env('MPESA_SANDBOX_TILL_NUMBER'),
            'ResponseType' => 'Confirmed',
            'ConfirmationURL' => $link.'/confirm',
            'ValidationURL' => $link.'/validate'
        );

        // return $curl_post_data;

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        // print_r($curl_response);

        return $curl_response;
    }

}
