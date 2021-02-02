<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function stkpush(Request $request)
    {
        $details = $request->validate([
            'phone' => 'required|string',
            'description' => 'required|string'
        ]);

        $num = $details['phone'];
        $desc = $details['description'];

        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $BusinessShortCode = '174379';
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = '1';
        $PartyA = '254769518626';
        $PartyB = $BusinessShortCode;
        $PhoneNumber = $num;
        $CallBackURL = url('/qtimeout');
        $AccountReference = 'TRA BY ANN';
        $TransactionDesc = $desc;
        $Remarks = 'Sample payment';
        $stkPushSimulation = $mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);

        return $stkPushSimulation;
    }

    /**
     * get account balances here

     */
    public function balance()
    {

        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $CommandID = 'AccountBalance';
        $Initiator = 'apitest425';
        $SecurityCredential = 'F8dGX6Es+rkdNgSE//bpIg7oUSPB+y9xxONNRJePwRiwBgWJ0mlaAORo3WO6gEHV7MPQd701WZj6xp2oCNr73DGA+v2QIToCGAscQIeEpst2dwwLktfBYmT1vTEQkQ2BQvXXwHBYf2i1NOQ6BJi+a+LwvsUN6N2gMjbnkGen2CX5SWJxs8iUscoUZSut7Zfei1swyuX1cFi0bMnBwjGrW64FKZzjDlQ7EHVnloLq/pko9spSyWeyZTy8Q7nbt0DXR+LiTrKiOXsXx0FZgQdQEjwVAcrKOWgXmtHPGoxTx9ObUzH2gca/B8SyqnrqPss3c0MX58E28kBRsrSuJ3wvbg==';
        $PartyA = '601425';
        $IdentifierType = '4';
        $Remarks = "balance enquiry";
        $ResultURL = 'https://cc4c08fc.ngrok.io/result';
        $QueueTimeOutURL = 'https://cc4c08fc.ngrok.io/qtimeout';


        $balanceInquiry = $mpesa->accountBalance($CommandID, $Initiator, $SecurityCredential, $PartyA, $IdentifierType, $Remarks, $QueueTimeOutURL, $ResultURL);

        return $balanceInquiry;
    }

    /**
     * B2ctransactions occur here
     */

    public function b2c()
    {
        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $InitiatorName = 'apitest425';
        $SecurityCredential = 'F8dGX6Es+rkdNgSE//bpIg7oUSPB+y9xxONNRJePwRiwBgWJ0mlaAORo3WO6gEHV7MPQd701WZj6xp2oCNr73DGA+v2QIToCGAscQIeEpst2dwwLktfBYmT1vTEQkQ2BQvXXwHBYf2i1NOQ6BJi+a+LwvsUN6N2gMjbnkGen2CX5SWJxs8iUscoUZSut7Zfei1swyuX1cFi0bMnBwjGrW64FKZzjDlQ7EHVnloLq/pko9spSyWeyZTy8Q7nbt0DXR+LiTrKiOXsXx0FZgQdQEjwVAcrKOWgXmtHPGoxTx9ObUzH2gca/B8SyqnrqPss3c0MX58E28kBRsrSuJ3wvbg==';
        $CommandID = 'SalaryPayment';
        $Amount = "100";
        $PartyA = "601425";
        $PartyB = "254700080373";
        $Remarks = "sample transaction";
        $ResultURL = 'https://cc4c08fc.ngrok.io/result';
        $QueueTimeOutURL = 'https://cc4c08fc.ngrok.io/qtimeout';
        $Occasion = "samp";



        $b2cTransaction = $mpesa->b2c($InitiatorName, $SecurityCredential, $CommandID, $Amount, $PartyA, $PartyB, $Remarks, $QueueTimeOutURL, $ResultURL, $Occasion);
        return $b2cTransaction;
    }
    /**
     * mpesa reversal start here
     * only reversal code goes in here
     *
     *
     */
    public function reverse()
    {
        $mpesa = new \Safaricom\Mpesa\Mpesa();

        $CommandID = 'TransactionReversal';
        $Initiator = 'apitest425';
        $SecurityCredential = 'F8dGX6Es+rkdNgSE//bpIg7oUSPB+y9xxONNRJePwRiwBgWJ0mlaAORo3WO6gEHV7MPQd701WZj6xp2oCNr73DGA+v2QIToCGAscQIeEpst2dwwLktfBYmT1vTEQkQ2BQvXXwHBYf2i1NOQ6BJi+a+LwvsUN6N2gMjbnkGen2CX5SWJxs8iUscoUZSut7Zfei1swyuX1cFi0bMnBwjGrW64FKZzjDlQ7EHVnloLq/pko9spSyWeyZTy8Q7nbt0DXR+LiTrKiOXsXx0FZgQdQEjwVAcrKOWgXmtHPGoxTx9ObUzH2gca/B8SyqnrqPss3c0MX58E28kBRsrSuJ3wvbg==';

        $TransactionID = 'OBE71HBBWZ';
        $Amount = '31083';
        $ReceiverParty = "601425";
        $RecieverIdentifierType = "11";
        $ResultURL = 'https://cc4c08fc.ngrok.io/result';
        $QueueTimeOutURL = 'https://cc4c08fc.ngrok.io/qtimeout';
        $remarks = "sample reversal";
        $ocassion = "request";
        $mpesa_response = $mpesa->reversal($CommandID, $Initiator, $SecurityCredential, $TransactionID, $Amount, $ReceiverParty, $RecieverIdentifierType, $ResultURL, $QueueTimeOutURL, $remarks, $ocassion);
        return json_encode($mpesa_response);
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

        $mpesa = new \Safaricom\Mpesa\Mpesa();

        $callbackData = $mpesa->getDataFromCallback();
        Storage::put('qtimeout.txt', $callbackData);
    }
    /**
     * Client to business requests occur here  occurs here
     *
     *
     *
     *
     */
    public function c2b()
    {

        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $ShortCode = '601425';
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

        $mpesa = new \Safaricom\Mpesa\Mpesa();

        $callbackData = $mpesa->getDataFromCallback();
        header("Content-Type:application/json");
        $resp = '{"ResultCode":0,"ResultDesc":"Confirmation recieved successfully"}';
        $mpesa_response = file_get_contents("php://input");
        // $mpesa_response="sample";

        $payment = Payment::create($mpesa_response);

        Log::info($payment);

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
        $mpesa = new \Safaricom\Mpesa\Mpesa();

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

        $mpesa = new \Safaricom\Mpesa\Mpesa();

        $callbackData = $mpesa->getDataFromCallback();
        Storage::put('result.txt', $callbackData);
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
            'ShortCode' => '601425',
            'ResponseType' => 'Confirmed',
            'ConfirmationURL' => '/confirm',
            'ValidationURL' => '/validate'
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
