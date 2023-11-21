<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class BooksController extends Controller
{
   public function index(Request $request){

      $pageNo = $request->page;
      $usertoken = session::get('userstoken');
      $curl = curl_init();
      $rechtmldata = '';
      $paidhtmldata = '';
      $htmldata = '';

      if ($request->ajax()) {

         curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.api_url').'e-book',
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
         $alldata = $data->response;
         $BooksArr = $alldata->data;
         $TopPaidArr = $alldata->top_paid;
         $recommendedArr = $alldata->recommendation;

         foreach($recommendedArr as $singleRecBook){

            $rechtmldata .= '<div class="col-xl-3 col-lg-4 col-md-6">';
            $rechtmldata .= '<div class="courses-box">';
            $rechtmldata .= '<div class="head">';
            $rechtmldata .= '<img src="'.$singleRecBook->image.'">';
            $rechtmldata .= '</div>';
            $rechtmldata .= '<div class="row">';
            $rechtmldata .= '<h4><a href="'.url("/bookDetails/1/".$singleRecBook->id).'">'.$singleRecBook->title.'</a></h4>';
            $rechtmldata .= '</div>';
            $rechtmldata .= '<div class="row">';
            $rechtmldata .= '<div class="col-6">';
            $rechtmldata .= '<div class="course-slider-detail">';
            $rechtmldata .= '<span>Price</span>';
            $rechtmldata .= '<b><i class="fa fa-inr" aria-hidden="true"></i> '.$singleRecBook->price.'</b>';
            $rechtmldata .= '</div>';
            $rechtmldata .= '</div>';
            $rechtmldata .= '<div class="col-6">';
            $rechtmldata .= '<div class="course-slider-detail">';
            $rechtmldata .= '<span>PDF</span>';
            $rechtmldata .= '<b><a href="'.$singleRecBook->ebook.'" tabindex="0" target="_blank">View</a></b>';
            $rechtmldata .= '</div>';
            $rechtmldata .= '</div>';
            $rechtmldata .= '</div>';
            $rechtmldata .= '</div>';
            $rechtmldata .= '</div>';
            $rechtmldata .= '</div>';
         }

         foreach($TopPaidArr as $singlePaidBook){

            $paidhtmldata .= '<div class="col-xl-3 col-lg-4 col-md-6">';
            $paidhtmldata .= '<div class="courses-box">';
            $paidhtmldata .= '<div class="head">';
            $paidhtmldata .= '<img src="'.$singlePaidBook->image.'">';
            $paidhtmldata .= '</div>';
            $paidhtmldata .= '<div class="row">';
            $paidhtmldata .= '<h4><a href="'.url("/bookDetails/2/".$singlePaidBook->id).'">'.$singlePaidBook->title.'</a></h4>';
            $paidhtmldata .= '</div>';
            $paidhtmldata .= '<div class="row">';
            $paidhtmldata .= '<div class="col-6">';
            $paidhtmldata .= '<div class="course-slider-detail">';
            $paidhtmldata .= '<span>Price</span>';
            $paidhtmldata .= '<b><i class="fa fa-inr" aria-hidden="true"></i> '.$singlePaidBook->price.'</b>';
            $paidhtmldata .= '</div>';
            $paidhtmldata .= '</div>';
            $paidhtmldata .= '<div class="col-6">';
            $paidhtmldata .= '<div class="course-slider-detail">';
            $paidhtmldata .= '<span>PDF</span>';
            $paidhtmldata .= '<b><a href="'.$singlePaidBook->ebook.'" tabindex="0" target="_blank">View</a></b>';
            $paidhtmldata .= '</div>';
            $paidhtmldata .= '</div>';
            $paidhtmldata .= '</div>';
            $paidhtmldata .= '</div>';
            $paidhtmldata .= '</div>';
            $paidhtmldata .= '</div>';
         }

         foreach($BooksArr as $singleBook){

            $htmldata .= '<div class="col-xl-3 col-lg-4 col-md-6">';
            $htmldata .= '<div class="courses-box">';
            $htmldata .= '<div class="head">';
            $htmldata .= '<img src="'.$singleBook->image.'">';
            $htmldata .= '</div>';
            $htmldata .= '<div class="row">';
            $htmldata .= '<h4><a href="'.url("/bookDetails/3/".$singleBook->id).'">'.$singleBook->title.'</a></h4>';
            $htmldata .= '</div>';
            $htmldata .= '<div class="row">';
            $htmldata .= '<div class="col-6">';
            $htmldata .= '<div class="course-slider-detail">';
            $htmldata .= '<span>Price</span>';
            $htmldata .= '<b><i class="fa fa-inr" aria-hidden="true"></i> '.$singleBook->price.'</b>';
            $htmldata .= '</div>';
            $htmldata .= '</div>';
            $htmldata .= '<div class="col-6">';
            $htmldata .= '<div class="course-slider-detail">';
            $htmldata .= '<span>PDF</span>';
            $htmldata .= '<b><a href="'.$singleBook->ebook.'" tabindex="0" target="_blank">View</a></b>';
            $htmldata .= '</div>';
            $htmldata .= '</div>';
            $htmldata .= '</div>';
            $htmldata .= '</div>';
            $htmldata .= '</div>';
            $htmldata .= '</div>';
         }

         return json_encode(['rechtmldata' => $rechtmldata, 'paidhtmldata' => $paidhtmldata, 'htmldata' => $htmldata, 'isNextPageAvailable' => 0]);
      }

      return view('books');
   }

   public function getBooksDetail($bookType, $id){

      $usertoken = session::get('userstoken');
      $curl = curl_init();

      curl_setopt_array($curl, array(
       CURLOPT_URL => config('app.api_url').'e-book',
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
      $alldata = $data->response;
      $resultArry = array();
      if($bookType == 1){

         $bookList = $alldata->recommendation;

      } else if($bookType == 2){

         $bookList = $alldata->top_paid;

      } else if($bookType == 3){

         $bookList = $alldata->data;
      }

      $key = array_search($id, array_column($bookList, 'id'));
      
      $bookTitle = $bookList[$key]->title;
      $bookUrl = $bookList[$key]->ebook;
      $bookDescription = $bookList[$key]->description;
      $bookPrice = $bookList[$key]->price;
      $bookImage = $bookList[$key]->image;
      $createdAt = $bookList[$key]->created_at;

      $BookData = array(
                     'id' => $id,
                     'bookTitle' => $bookTitle,
                     'bookUrl' => $bookUrl,
                     'bookDescription' => $bookDescription,
                     'bookPrice' => $bookPrice,
                     'bookImage' => $bookImage,
                     'createdAt' => $createdAt,
                  );
      
      return view('bookDetails',["data" => $BookData]);

   }
}