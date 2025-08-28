<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\TestsController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['middleware'=>'web'],function(){

   Route::get('Login',[LoginController::class,'login'])->name('Login');
   Route::get('Register',[LoginController::class,'register'])->name('Register');
   Route::get('forgotPassword',[LoginController::class,'forgotPasswordForm'])->name('forgotPassword');
   Route::post('forgotPassword',[LoginController::class,'forgotPasswordAPI'])->name('forgotPassword');
   Route::post('Register',[LoginController::class,'registeruser'])->name('Register');
   Route::get('/',[HomeController::class,'index']);
   Route::get('Chapters',[ChapterController::class,'index']);
   Route::get('books',[BooksController::class,'index']);
   Route::get('bookDetails/{bookType}/{id}',[BooksController::class,'getBooksDetail']);
   Route::get('membership',[MembershipController::class,'index']);
   Route::get('Tests',[TestsController::class,'index']);
   Route::get('testSets/{id}',[TestsController::class,'testSetIndex']);
   Route::get('testReport/{id}',[TestsController::class,'testReportIndex']);
   Route::get('testQuestions/{testId}/{index}',[TestsController::class,'getSetQuestions']);
   Route::get('test/data',[TestsController::class,'testData'])->name('test-data');
   Route::get('Logout',[LoginController::class,'Logout'])->name('Logout');
   Route::view('Checkotp',[LoginController::class,'Checkotp']);
   Route::view('/Checkotp', 'checkotp');
   Route::post('Checkotp',[LoginController::class,'verifyOtp'])->name('Checkotp');
   Route::get('courseList',[CourseDetailController::class,'getCourseLists']);
   Route::get('courseDetails/{id}',[CourseDetailController::class,'getSingleCourseDetail']);
   Route::get('userProfile',[UserController::class,'index']);
   Route::view('updatePassword','updatePassword');
   Route::post('updatePassword', [UserController::class, 'updatePassword'])->name('updatePasswordAftReg.post');
   Route::post('userProfile', [UserController::class, 'updateUserProfile'])->name('updateUserProfile.post');
   Route::post('post-userProfile', [UserController::class, 'updatePassword'])->name('updatePassword.post');

   Route::get('payment-razorpay', [PaymentController::class, 'razorpayProduct']);
   // Route::get('paysuccess', [PaymentController::class, 'razorPaySuccess']);
   Route::get('thankYou', [PaymentController::class, 'thankyouIndex']);
});

Route::post('post-login', [LoginController::class, 'postLogin'])->name('login.post');

