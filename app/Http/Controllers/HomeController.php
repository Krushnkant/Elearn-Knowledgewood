<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class HomeController extends Controller
{
  //
  public function index()
  {

    $usertoken = session::get('userstoken');
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => config('app.api_url') . 'home/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $usertoken
      ),
    )
    );

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
    $data = json_decode($response);
    return view('home', ["data" => $data]);

  }
}
