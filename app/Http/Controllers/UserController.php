<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class UserController extends Controller
{
	public function index(){

        $usertoken = session::get('userstoken');

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

        if($data['success'] == 1){
            $UserFields = $data['data'];
            Session::put('users', $UserFields);
        }

		return view('userProfile');
	}

	public function updateUserProfile(Request $request){

        $username = Session::get('username');
		$request->validate([
            'fullname' => 'required',
        ],
        [
            'fullname.required' => 'The Name field is required'
        ]);
        $fullname = $request->fullname;
        $nickname = $request->nickname;
        $gender = $request->gender;
        $bio = $request->bio;
        $usertoken = session::get('userstoken');

        $response = Http::post(config('app.api_url').'update-user', [
        	'username' => $username,
            'name' => $fullname,
            'nickname' => $nickname,
            'gender' => $gender,
            'bio' => $bio,
            'headers' => [
             	'Authorization' => 'Bearer '.$usertoken,
             	'Content-Type' => 'application/json',
      		],
        ]);
        $userdata = $response->json();

        if($userdata['success'] == 1){
            Session::put('users', $userdata['data']);
            //$data= Session::get('users');
            return redirect()->intended('/userProfile')->with('profileFormSuccess',$userdata['message']);
        }

        return redirect()->intended('/userProfile')->with('profileFormErr',$userdata['message']);
	}

    public function updatePassword(Request $request){

        $username = $request->username;
        $password = trim($request->password);
        $password_confirmation = trim($request->password_confirmation);
        $page = $request->page;
        // $usertoken = session::get('userstoken');
        $isForgotPassAPICall = session::get('isForgotPassAPICall');

        $request->validate([
            'username' => 'required|min:8',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ],
        [
            'username.required' => 'The Username field is required',
            'username.min' => 'The password must be at least 8 characters',
            'password.required' => 'The Password field is required',
            'password.min' => 'The password must be at least 6 characters',
            'password_confirmation.required' => 'The Confirm Password field is required'
        ]);

        $response = Http::post(config('app.api_url').'update-password', [
            'username' => $username,
            'password' => $password,
            'confirm_password' => $password_confirmation,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
        $userdata = $response->json();

        if($userdata['success'] == 1){

            Session::put('username', $username);
            Session::put('users', $userdata['data']);
            Session::put('userstoken', $userdata['token']['access_token']);

            if($isForgotPassAPICall == true){
                return redirect()->intended('/Logout');
            }

            if($page == 'updatePassword'){
                return redirect()->intended('/userProfile');
            } else {
                return redirect()->intended('/userProfile')->with('passWordFormSuccess',$userdata['message']);
            }
        }

        if($page == 'updatePassword'){
            return redirect("updatePassword")->with('passWordFormErr', $userdata['message']);
        } else {
            return redirect("userProfile")->with('passWordFormErr', $userdata['message']);
        }
    }
}
?>