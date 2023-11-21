<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class CourseDetailController extends Controller
{
    /*public function getCourseLists(){
        
        $usertoken = session::get('userstoken');
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => config('app.api_url').'courses/',
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
        return view('courseList',["data" => $data]);
    }*/

    public function getCourseLists(Request $request){
        
      $pageNo = $request->page;
      $usertoken = session::get('userstoken');
      $curl = curl_init();
      $isNextPageAvailable = 1;
      $htmldata = '';

      if ($request->ajax()) {

        curl_setopt_array($curl, array(
          CURLOPT_URL => config('app.api_url').'courses/?page='.$pageNo,
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
        $alldata = $data->data;
        $CourcesArr = $alldata->data;
        $lastPage = $alldata->last_page;

        foreach($CourcesArr as $singleCourse){

          $htmldata .= '<div class="col-xl-3 col-lg-4 col-md-6">';
          $htmldata .= '<div class="courses-box">';
          $htmldata .= '<div class="head">';
          $htmldata .= '<img src="'.$singleCourse->image.'">';
          $htmldata .= '</div>';
          $htmldata .= '<div class="row">';
          $htmldata .= '<h4><a href="'.url("/courseDetails/".$singleCourse->id).'">'.$singleCourse->name.'</a></h4>';
          $htmldata .= '</div>';
          $htmldata .= '<div class="row">';
          $htmldata .= '<div class="col-6">';
          $htmldata .= '<div class="course-slider-detail">';
          $htmldata .= '<span>Duration</span>';
          $htmldata .= '<b>'.$singleCourse->duration.'</b>';
          $htmldata .= '</div>';
          $htmldata .= '<div class="course-slider-detail">';
          $htmldata .= '<span>Books</span>';
          $htmldata .= '<b>NA</b>';
          $htmldata .= '</div>';
          $htmldata .= '</div>';
          $htmldata .= '<div class="col-6">';
          $htmldata .= '<div class="course-slider-detail">';
          $htmldata .= '<span>Skill Level</span>';
          $htmldata .= '<b>'.$singleCourse->skill->name.'</b>';
          $htmldata .= '</div>';
          $htmldata .= '<div class="course-slider-detail">';
          $htmldata .= '<span>Training Mode</span>';
          $htmldata .= '<b>'.$singleCourse->trainnig_mode.'</b>';
          $htmldata .= '</div>';
          $htmldata .= '</div>';
          $htmldata .= '</div>';
          $htmldata .= '</div>';
          $htmldata .= '</div>';

        }

        if($lastPage == $pageNo){
          $isNextPageAvailable = 0;
        }

        return json_encode(['htmldata' => $htmldata, 'isNextPageAvailable' => $isNextPageAvailable]);
      }
      // return view('courseList',["data" => $data]);
      return view('courseList'); 
    }

    public function getSingleCourseDetail($id){
        
      $usertoken = session::get('userstoken');
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => config('app.api_url').'courses/'.$id,
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
      return view('courseDetails',["data" => $data]);
       
    }

}
