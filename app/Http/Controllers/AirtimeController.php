<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class AirtimeController extends Controller
{
    private $authorization;

    public function __construct()
    {
        // Assign initial value to $authorization
        $this->authorization = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2OTExMzI1NTg5OTF9._LjQxvobTKBmD5K1hOMoWG8HGYElYO9GX4Km9V7ib8s';
    }


    //
    public function topup(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'denomination' => 'required',
            'agent_id' => 'required',
        ]);

        $phoneNumber = $request->input('phone_number');
        $denomination = $request->input('denomination');
        $agent_id = $request->input('agent_id');
        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);

        $url = "https:/clients.primeairtime.com/api/topup/exec/$phoneNumber";
       // $authorization = "Bearer " . env('PRIME_BEARER_TOKEN'); // Retrieve the bearer token from the .env file
       $token = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');
        $authorization = "Bearer " .$token; // Retrieve the bearer token from the construct
        //$authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2ODk3ODc1MzA4ODd9.TDwvq6TXVXhATAr_Z_vI5yHqDDAFoNenPfSIZ544LQw";
        //$authorization = $this->authorization;
        //return $authorization;
        $data = [
            "product_id" => "MFIN-5-OR",
            "denomination" => $denomination,
            "send_sms" => false,
            "sms_text" => "",
            "customer_reference" => $refnumber
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: $authorization"
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        //return $response;
        

        if ($response === false) {
            
            return response()->json(['error' => 'cURL Error: ' . curl_error($ch)], 500);
           // return response()->json(['error' => 'API Request Failed'], 500);
        }


        //$agent_id = rand(1, 899);
        $agent = DB::table('tbl_agents')
            ->select('first_name', 'last_name')
            ->where('id', $agent_id)
            ->first();

        $agent_names = null;
        if ($agent) {
            $agent_names = $agent->first_name . ' ' . $agent->last_name;
        }
        

       // Process the API response
        $responseData = json_decode($response, true);

        // Extract the desired data from the API response
        $productId = $responseData['product_id'];
        $target = $responseData['target'];
        $topupAmount = $responseData['topup_amount'];
        $paidCurrency = $responseData['paid_currency'];
        $customer_reference = $responseData['customer_reference'];
    
        // Store the data into the tbl_transactions table using the DB facade
        DB::table('tbl_transactions')->insert([
            'Name' => $productId,
            'BillerName' => $target,
            'ConsumerIdField' => $agent_names,
            'agent_id' => $agent_id,
            'customer_reference' => $customer_reference,
            'ItemFee' => $topupAmount,//customer_reference
            'transaction_type' => 'billpayment',
            'CurrencySymbol' => $paidCurrency,
            'BillerType' => 'Airtime Top up',
        ]);


        DB::table('tbl_commissions')->insert([
            'transaction_id' => $customer_reference,
            'agent_id' => $agent_id,
            'amount' => $topupAmount,
            'commission' => $topupAmount*0.015,
            'date' => $todayDate,
            'type' => 'Debit',
        ]);


        // Return the API response in a well-structured manner
        return response()->json($responseData, 200);
        
    }


    public function datatopup(Request $request)
    {

        $request->validate([
            'phone_number' => 'required',
            'denomination' => 'required',
            'agent_id' => 'required',
        ]);
        
        $phoneNumber = $request->input('phone_number');
        $denomination = $request->input('denomination');
        $agent_id = $request->input('agent_id');
        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);

        $url = "https:/clients.primeairtime.com/api/datatopup/exec/$phoneNumber";
        //$authorization = "Bearer " . env('PRIME_BEARER_TOKEN'); // Retrieve the bearer token from the .env file
       // $authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2ODk3ODc1MzA4ODd9.TDwvq6TXVXhATAr_Z_vI5yHqDDAFoNenPfSIZ544LQw";
       $token = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');
        $authorization = "Bearer " .$token; // Retrieve the bearer token from the construct
        //return $authorization;
        $data = [
            "product_id" => "D-MFIN-5-50",
            "denomination" => $denomination,
            "send_sms" => false,
            "sms_text" => "",
            "customer_reference" => $refnumber
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: $authorization"
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

       //return $response;

        if ($response === false) {
            
            return response()->json(['error' => 'cURL Error: ' . curl_error($ch)], 500);
           // return response()->json(['error' => 'API Request Failed'], 500);
        }


       // $agent_id = rand(1, 899);
        $agent = DB::table('tbl_agents')
            ->select('first_name', 'last_name')
            ->where('id', $agent_id)
            ->first();

        $agent_names = null;
        if ($agent) {
            $agent_names = $agent->first_name . ' ' . $agent->last_name;
        }
        

       // Process the API response
    $responseData = json_decode($response, true);

     // Extract the desired data from the API response
     $productId = $responseData['product_id'];
     $target = $responseData['target'];
     $topupAmount = $responseData['topup_amount'];
     $paidCurrency = $responseData['paid_currency'];
     $customer_reference = $responseData['customer_reference'];
 
     // Store the data into the tbl_transactions table using the DB facade
     DB::table('tbl_transactions')->insert([
         'Name' => $productId,
         'BillerName' => $target,
         'ConsumerIdField' => $agent_names,
         'agent_id' => $agent_id,
         'customer_reference' => $customer_reference,
         'ItemFee' => $topupAmount,
         'transaction_type' => 'billpayment',
         'CurrencySymbol' => $paidCurrency,
         'BillerType' => 'Data Top up',
     ]);

     DB::table('tbl_commissions')->insert([
        'transaction_id' => $customer_reference,
        'agent_id' => $agent_id,
        'amount' => $topupAmount,
        'commission' => $topupAmount*0.015,
        'date' => $todayDate,
        'type' => 'Debit',
    ]);


    // Return the API response in a well-structured manner
    return response()->json($responseData, 200);
        
    }
}
