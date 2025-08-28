<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use Log;

class TestsController extends Controller
{
  public function index(Request $request)
  {

    $pageNo = $request->page;
    $usertoken = session::get('userstoken');

    if ($request->ajax()) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => config('app.api_url') . 'mock-test-test?per-page=10&page=' . $pageNo,
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
      ));

      $response = curl_exec($curl);
      curl_close($curl);
      //echo $response;
      $data = json_decode($response);
      $TestArr = $data->data;

      $SingleBox = array();
      foreach ($TestArr as $singleTest) {

        $rechtmldata = '';
        $rechtmldata .= '<div class="col-xl-3 col-lg-4 col-md-6">';
        $rechtmldata .= '<div class="courses-box">';
        $rechtmldata .= '<div class="head">';
        $rechtmldata .= '<img src="' . $singleTest->image . '">';
        $rechtmldata .= '</div>';
        $rechtmldata .= '<div class="row">';
        $rechtmldata .= '<h4><a href="' . url("/testSets/" . $singleTest->id) . '">' . $singleTest->title . '</a></h4>';
        $rechtmldata .= '</div>';
        $rechtmldata .= '<div class="row">';
        $rechtmldata .= '<div class="col-6">';
        $rechtmldata .= '<div class="course-slider-detail">';
        $rechtmldata .= '<span>Question</span>';
        $rechtmldata .= '<b>' . $singleTest->number_of_questions . '</b>';
        $rechtmldata .= '</div>';
        $rechtmldata .= '</div>';
        $rechtmldata .= '<div class="col-6">';
        $rechtmldata .= '<div class="course-slider-detail">';
        $rechtmldata .= '<span>Mock Exam</span>';
        $rechtmldata .= '<b>' . $singleTest->mock_exam . '</b>';
        $rechtmldata .= '</div>';
        $rechtmldata .= '</div>';
        $rechtmldata .= '</div>';
        $rechtmldata .= '</div>';
        $rechtmldata .= '</div>';
        $rechtmldata .= '</div>';

        $SingleBox[] = $rechtmldata;
      }

      return json_encode(['responseJson' => $SingleBox]);
    }

    return view('tests');
  }

  public function testSetIndex($id, Request $request)
  {

    $pageNo = $request->page;
    $usertoken = session::get('userstoken');
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => config('app.api_url') . 'mock-test-test?per-page=10&page=' . $pageNo,
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
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
    $data = json_decode($response);
    $alldata = $data->data;

    $key = array_search($id, array_column($alldata, 'id'));

    $title = $alldata[$key]->title;
    $number_of_questions = $alldata[$key]->number_of_questions;
    $skill_id = $alldata[$key]->skill_id;
    $mock_exam = $alldata[$key]->mock_exam;
    $image = $alldata[$key]->image;
    $description = $alldata[$key]->description;
    $sets = $alldata[$key]->sets;
    $skill = $alldata[$key]->skill;

    $TestData = array(
      'id' => $id,
      'title' => $title,
      'number_of_questions' => $number_of_questions,
      'skill_id' => $skill_id,
      'mock_exam' => $mock_exam,
      'image' => $image,
      'description' => $description,
      'sets' => $sets,
      'skill' => $skill,
    );

    return view('testSets', ["data" => $TestData]);
  }

public function getSetQuestions(Request $request, $testId, $index)
{
    $usertoken = session::get('userstoken');
    $loggedInUserData = session::get('users');
    $UserId = $loggedInUserData['id'];
    $setType = 'set' . $index;
    $PostAnsApiUrl = config('app.api_url') . "post-answer";
    $baseUrl = asset('/');
    $courseId = '';
    $assessmentId = '';

    $CustomQueArr = array();
    if ($request->ajax()) {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api_url') . $testId . '/questions-start-test/' . $index,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('set_type' => $setType),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $usertoken
            ),
        ));
        $response = curl_exec($curl);
        $data = json_decode($response);

        $alldata = array();
        $totalQuestions = count($data->data); // Fixed total of 180 questions
        
        if ($data->success == 1) {
            $alldata = $data->data;
            $courseId = 0;
            $assessmentId = 0;

            // Get question_no from API response (how many questions user has attended)
            $questionsAttended = 0;
            if (isset($data->question_no) && $data->question_no > 0) {
                $questionsAttended = (int)$data->question_no; 
            }

            // Start from the next question (if attended 4, start from 5)
            $startFrom = $questionsAttended + 1;
            
            $currentQuestionNumber = 1;
            $questionsAdded = 0;
            
            foreach ($alldata as $singleQue) {
                // Get course and assessment ID from first question
                if ($questionsAdded == 0) {
                    $courseId = $singleQue->course_id;
                    $assessmentId = $singleQue->assessment_id;
                }

                // Only add questions starting from the calculated start position
                if ($currentQuestionNumber >= $startFrom) {
                    $Options = $singleQue->question_options;
                    $optsArr = array();
                    $optInd = 0;
                    $corIndex1 = array();
                    foreach ($Options as $opts) {
                        $optsArr[] = array(
                            "optsId" => $opts->id,
                            "optsTxt" => $opts->options,
                        );
                        if ($opts->is_correct == 1) {
                            $corIndex = $optInd; // Correct Index
                            $corIndex1[] = $optInd;
                        }
                        $optInd++;
                    }

                    $CustomQueArr[] = array(
                        "qId" => $singleQue->id,
                        "q" => $singleQue->title,
                        "options" => $optsArr,
                        "corIndex" => $corIndex,
                        "corIndex1" => implode(',', $corIndex1),
                        "corIndexCount" => count($corIndex1),
                        "correctResponse" => $singleQue->explanation,
                        "incorrectResponse" => $singleQue->explanation,
                    );
                    $questionsAdded++;
                }

                $currentQuestionNumber++;
                
                // Stop if we've reached the total questions limit
                if ($currentQuestionNumber > $totalQuestions) {
                    break;
                }
            }
        }

        return json_encode([
            'baseUrl' => $baseUrl, 
            'apiUrl' => $PostAnsApiUrl, 
            'courseId' => $courseId, 
            'assessmentId' => $assessmentId, 
            'userId' => $UserId, 
            'alldata' => $CustomQueArr, 
            'usertoken' => $usertoken,
            'stop_time' => $data->stop_time ?? 14400,
            'totalQuestions' => $totalQuestions, // Send total to frontend
            'questionsAttended' => $questionsAttended + 1, // Send attended count to frontend
        ]);
    }
    
    $setType = $index;
    return view('testQuestions', compact('setType'));
}
    public function testReportIndex($id)
    {

        $usertoken = session::get('userstoken');
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => config('app.api_url') . $id . '/test-results',
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
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;
        $data = json_decode($response);

        return view('testReport', ['alldata' => $data]);
      }

      public function testData(Request $request)
      {

          $usertoken = session::get('userstoken');

          $curl = curl_init();

          curl_setopt_array($curl, [
              CURLOPT_URL => config('app.api_url') . 'post-answer-test',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => json_encode($request->all()), // ✅ send data as JSON
              CURLOPT_HTTPHEADER => [
                  'Content-Type: application/json',
                  'Authorization: ' . 'Bearer ' . $usertoken,
              ],
          ]);

          $response = curl_exec($curl);

          if (curl_errno($curl)) {
              // Handle curl error
              $error_msg = curl_error($curl);
              curl_close($curl);
              return response()->json(['error' => $error_msg], 500);
          }

          curl_close($curl);
          return response()->json(json_decode($response, true)); // ✅ return API response as JSON
          //echo $response;
      }
}
