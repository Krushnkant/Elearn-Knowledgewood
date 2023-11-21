<?php
 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 use App\Models\Payment;
 use Redirect,Response;
 use Session;
 
 class PaymentController extends Controller
 {
     public function razorpayProduct()
     {
       return view('membership');
     }
 
     public function razorPaySuccess(Request $Request){
        $data = [
                 'user_id' => '1',
                 'product_id' => $request->product_id,
                 'r_payment_id' => $request->payment_id,
                 'amount' => $request->amount,
              ];

        $getId = Payment::insertGetId($data);  
        $arr = array('msg' => 'Payment successfully credited', 'status' => true);

        return Response()->json($arr);
     }
 
     public function thankyouIndex()
     {
        $usertoken = session::get('userstoken');
        $ActivePlan = '';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api_url').'user-profile',
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

        // $userdata = $response->json();
        $data = json_decode($response, true);
        // print_r($data);
        if($data['success'] == 1){

            $UserFields = $data['data'];
            $ActivePlanArr = $UserFields['active_plan'];
            $ActivePlan = $ActivePlanArr['plan'];
            Session::put('users', $UserFields);
        }

        return view('thankYou', ['activePlan' => $ActivePlan]);
     }
 }