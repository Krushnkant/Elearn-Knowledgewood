<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
class HomeController extends Controller
{
    //
    public function index(){
    
    //   $response = Http::get(config('app.api_url'), [
    // 'name' => 'Taylor',
    // 'page' => 1,
    // ]);
    //   return $response->json();
     
    //  $response = Http::get(config('app.api_url').'home/', [
    // 'headers' => [
    //     'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiYTM4NzY1OGU2YjMwODI1MzkyZDg2M2YyOGMxNjZlYWFhYTM2MzM2MjdiYmM2NTJkM2EwZGRkMjdjMmNmNDYyM2Y3ZmEwZDViN2Y4YWY4YzUiLCJpYXQiOjE2NDI1MTAxMzguMTQxOCwibmJmIjoxNjQyNTEwMTM4LjE0MTgwNCwiZXhwIjoxNjc0MDQ2MTM4LjEzOTQyMywic3ViIjoiMTk2Iiwic2NvcGVzIjpbXX0.n5wzK3jhAGTGfV7Yc4u3IqVBSYHhJFEYA6rxfOq1m_9ggBWo5nE6TeZyR7GWoArDKJnbiIvRixZq6PsKDfvqE52MU27xchjbt5lnsnxR9Xmv_NKNO6fK8WQEvlotewaywqnuuV5V8GGkPYEBIJf9QJW64z-wi7ppZohWbFR4goB0JF-m0ngJX7kNuxew8mPIiFyizQBaRQQTvIVm_ZMoFKp8YEdDnQ8HvEP0UOltaSOPe4kZWANbCP_jfCzoTRYTrLsSwN8qZMMbYEQEYA8DQY0N0BDimkzoSOVl0p0AmKisKxgwCJH1m1ivoarD5JHWEaKpuFse4J3808gfW8fI63hpcYxpvAVB_ZdHiwptES1yFYuB-OI4vJPTnZ3eMOh088JEVwe23IVn6EjAHCSsjIfYEK8DizmJfjz9bLVUmVgisSDYbfokMDcs8ecJJGDab_paEx1d151XAY50BxuzohKtc2ddqX3daX1z1XkbKj4nuu_MxGePOHUEx4OQ8Z1RYDGnombOPP8CT0t56MMBu7jyzKm-xUpLGbNw_E3riWrCuPN9bS-E9F2-DCRdyTGNdL0qrDBAU6PH3eTPq_q3ufFKypxL7FPEo5oVwxjDMOMJsUadyJHEq0pdWEztWGXd3sbyLCBgJJxfGSUWMaa7_gVdlzTIkLMsy6Rte0djyO4',
    //     'Content-Type' => 'application/json',
    //   ],
    // ]);
    //  return  $responseBody = json_decode($response->getBody());
     //return $response->json(); 
      // return view('home');


    $usertoken = session::get('userstoken');
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => config('app.api_url').'home/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$usertoken
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
    $data = json_decode($response);
    return view('home',["data" => $data]);

    }
}
