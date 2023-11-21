<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class LoginController extends Controller
{
    public function login(){

       return view('login');
       
    }

    public function postLogin(Request $request){
        //print_r($request->input()); die;
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'username.required' => 'The User Name field is required',
            'password.required' => 'The Password field is required'
        ]);
        $username = $request->username;
        $password = $request->password;

        $response = Http::post(config('app.api_url').'login', [
             'username' => $username,
             'password' => $password,
        ]);
        $userdata = $response->json();

        if($userdata['success'] == 1){
            Session::put('users', $userdata['data']);
            Session::put('userstoken', $userdata['token']['access_token']);
            //$data= Session::get('users');
            return redirect()->intended('/')->withSuccess($userdata['message']);
        }

        return redirect("Login")->withError($userdata['message']);
    }

    public function logout(Request $res){

        Session::pull('userstoken');
        Session::pull('users');
        Session::pull('username');
        Session::pull('isForgotPassAPICall');
        return redirect('/Login');
    }

    public function register(){

       return view('register');
    }

    public function registeruser(Request $request){
      //print_r($request->input()); die;
        $request->validate([
            'username' => 'required',
            'name' => 'required',
        ],
        [
            'username.required' => 'The Mobile No field is required',
            'name.required' => 'The Name field is required'
        ]);
        $username = $request->username;
        $name = $request->name;

        $response = Http::post(config('app.api_url').'register', [
             'username' => $username,
             'name' => $name,
         ]);
        $userdata = $response->json();
        //print_r($userdata); die;
        if($userdata['success'] == 1){
            Session::put('username', $username);
            // Session::put('userstoken', $userdata['token']['access_token']);
            //$data= Session::get('users');
            return redirect()->intended('/Checkotp')->withSuccess($userdata['message']);
        }
        
        return redirect("/Register")->withError($userdata['message']);
    }
    
    public function verifyOtp(Request $request){
      //print_r($request->input()); die;
        $request->validate([
            'otp' => 'required|integer'
        ]);
        $username = Session::get('username');
        $otp = $request->otp;

        $response = Http::post(config('app.api_url').'otp-verify', [
             'username' => $username,
             'otp' => $otp,
         ]);
        $userdata = $response->json();
        //print_r($userdata); die;
        if($userdata['success'] == 1){
            return redirect()->intended('/updatePassword')->withSuccess($userdata['message']);
        }
        return redirect("/Register")->withError($userdata['message']);
    }

    public function forgotPasswordForm(){
      
        return view("forgotPassword");
    }

    public function forgotPasswordAPI(Request $request){
        
        //print_r($request->input()); die;
        $request->validate([
            'username' => 'required'
        ],
        [
            'username.required' => 'The Username field is required'
        ]);
        $username = $request->username;

        $response = Http::post(config('app.api_url').'forget-password', [
            'username' => $username
        ]);
        $otpdata = $response->json();

        if($otpdata['success'] == 1){
            Session::put('username', $username);
            Session::put('isForgotPassAPICall', true);
            return redirect()->intended('/Checkotp')->withSuccess('OTP has been sent to your Register Mobile Number');
        }
        
        return redirect("/forgotPassword")->withError($otpdata['message']);
    }

}
