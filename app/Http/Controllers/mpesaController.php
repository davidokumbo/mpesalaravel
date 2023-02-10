<?php

namespace App\Http\Controllers;

use App\Models\Json;
use App\Models\Transaction;
use Carbon\Carbon;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Mpesa;





class mpesaController extends Controller
{
    public function lipaNaMpesaPassword()
    {
        $timestamp = Carbon::rawParse('now')->format('YmdHms');
        $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $businessShortCode = 174379;
        $mpesapassword = base64_encode($businessShortCode . $passkey . $timestamp);
        return $mpesapassword;
    }


    public function newAccessToken()
    {
        // $consumerkey="d2G16hLksRXBo07YYtX89paRGbnoqABR";
        // $consumersecret="FVS8wsUVPILuLHeI";
        // $credentials = base64_encode($consumerkey.":".$consumersecret);
        // $url="https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        // // $response = Http::withBasicAuth($consumerkey, $consumersecret)->get($url);
        // // return $response;

        // $curl= curl_init();
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials,"Content-Type:application/json"));
        // curl_setopt($curl, CURLOPT_HEADER, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // $curl_response=curl_exec($curl);
        // $access_token=json_decode($curl_response);
        // curl_close($curl);
        // return $access_token->access_token;


        $mpesa = new \Safaricom\Mpesa\Mpesa();
            $BusinessShortCode =174379;
            $LipaNaMpesaPasskey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
            $TransactionType="CustomerPayBillOnline";
            $Amount="1";
            $PartyA="254746717753";
            $PartyB="174379"; 
            $PhoneNumber="254746717753";
            $CallBackURL="https://9fa3-105-163-2-250.eu.ngrok.io/api/mpesacallback";
            $AccountReference="Professor David Payment System";
            $TransactionDesc="Lipa Na Mpesa Web Development";
            $Remarks = "Thank you for your payment";

        $stkPushSimulation = $mpesa->STKPushSimulation(
            $BusinessShortCode,
            $LipaNaMpesaPasskey,
            $TransactionType,
            $Amount,
            $PartyA,
            $PartyB,
            $PhoneNumber,
            $CallBackURL,
            $AccountReference,
            $TransactionDesc,
            $Remarks
        );

    }

    public function mpesacallback(Request $request){
        $response=$request->getContent();
        $trans = new Transaction;
        $trans->Response=json_encode($response);
        $trans->save();
        return $responsey=json_encode($request->getContent());
    }
    public function getdata(){
        $res = Transaction::select("InvoiceNumber")
                           ->where("id",6)
                           ->get();
        // dd($res);

        foreach($res as $value){
            return $value;
        }
    }

    public function jsonmethod(){
       
       

        $skip=0;
        $limit = 100;
         do {
            $url = 'https://api.fda.gov/food/enforcement.json?limit='.$limit.'&skip=' . $skip;

            $data_string = array();
            $curl = curl_init();
            $test = http_build_query($data_string);
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_POSTFIELDS => $test,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 100,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            set_time_limit(600);
            curl_close($curl);
            $jsondata = json_decode(curl_exec($curl));
            $total = $jsondata->meta->results->total;
            $limit = $jsondata->meta->results->limit;
            $results = $jsondata->results;
            $count = 0;
        foreach($results as $resultarrays){
             $count++;
            $jsoninfo = new Json;
            
            $jsoninfo->country= $resultarrays->country;
            $jsoninfo->city= $resultarrays->city;
            $jsoninfo->address_1=$resultarrays->address_1;
            $jsoninfo->reason_for_recall=$resultarrays->reason_for_recall;
            $jsoninfo->address_2=$resultarrays->address_2;
            $jsoninfo->product_quantity=$resultarrays->product_quantity;
            $jsoninfo->code_info=$resultarrays->code_info;
            $jsoninfo->center_classification_date=$resultarrays->center_classification_date;
            $jsoninfo->distribution_pattern=$resultarrays->distribution_pattern;
            $jsoninfo->state=$resultarrays->state;
            $jsoninfo->product_description=$resultarrays->product_description;
            $jsoninfo->report_date=$resultarrays->report_date;
            $jsoninfo->classification=$resultarrays->classification;
            $openfd=$resultarrays->openfda;
            foreach($openfd as $key=>$value){
                if(is_null($key)){
                    $jsoninfo->openfda="null";
                }else{
                    $jsoninfo->openfda=$key;
                }
             }
             $jsoninfo->recalling_firm=$resultarrays->recalling_firm;
             $jsoninfo->recall_number=$resultarrays->recall_number;
             $jsoninfo->initial_firm_notification=$resultarrays->initial_firm_notification;
             $jsoninfo->product_type=$resultarrays->product_type;
             $jsoninfo->event_id=$resultarrays->event_id;
             
            if(empty($resultarrays->more_code_info)){
                    $jsoninfo->more_code_info = "null";
              }else{
                $jsoninfo->more_code_info=$resultarrays->more_code_info;
              }
           
              $jsoninfo->recall_initiation_date = $resultarrays->recall_initiation_date;
              $jsoninfo->postal_code=$resultarrays->postal_code;
              $jsoninfo->voluntary_mandated=$resultarrays->voluntary_mandated;
              $jsoninfo->status=$resultarrays->status;
              $jsoninfo->save();
             
        }
        

          $rem = $total-$skip;
            if($rem<100){ 
                $skip = $skip + $rem;
                $limit == $rem;
            }else{
                $skip=$skip+$limit; 
            }     

        }while($skip<=$total);



            
        //     $skip=0;
        //     do {
        //     $url ="https://api.fda.gov/food/enforcement.json?limit=100&skip=".$skip;
        //     $jsondata = (object) Http::get($url)->json();
        //     $results = (object) $jsondata->results;
        //     $total = (object) $jsondata->meta;
        //     $totalreal = (object) $total->results;
        //     $skip = $totalreal->skip;
        //     $limit = $totalreal->limit;
        //     $total = $totalreal->total;
        //      $url;
        //      "</br>";
        //      "</br>";
        //     $count = 0;
        //     foreach($results as $resultarrays){
        //         $count++;
        //         $resultdata = (object) $resultarrays;
        //          $count . "";
        //         print_r($resultdata->city);
        //          "</br>";

        //     }
            
        //     $rem = $total-$skip;
        //     if($rem<100){ 
        //         $skip = $skip + $rem;
        //     }else{
        //         $skip=$skip+$limit; 
        //     }
            

        // }while($skip<=$total);
       
         
     
    }
    public function jsoncontroller(){
        $data = Json::all();
        
        return view('json',['data' => $data]);
    }

}