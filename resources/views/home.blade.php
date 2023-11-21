@include("header")
<?php 
  $alldata = $data->data;
  $continueReading = $alldata->continueReading;
  $videoCourcesArr = $alldata->videoCources;
  $ebooksArr = $alldata->ebooks;
  $mockTestArr = $alldata->mockTest;
  //print_r($alldata->continueReading); die;
?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">

<section class="mt-4 mb-4">
  <div class="container">
    <div class="title">
      <h4>Continue studying</h4>
    </div>
    <div class="course-slider">
      @foreach($continueReading as $reading)
        <div>
          <div class="course-slider-cont">
            <h4>{{ $reading->name }}</h4>
            <div class="row align-items-center">
              <div class="col-6">
                <div class="course-slider-detail">
                  <span>Questions</span>
                  <b>23/200</b>
                </div>
                <div class="course-slider-detail">
                  <span>Skill Level</span>
                  <b>{{ $reading->skill->name }}</b>
                </div>
                <div class="course-slider-detail">
                  <span>Mock Exam</span>
                  <b>{{ $reading->mock_exam_count}}</b>
                </div>
              </div>
               <div class="col-6">
                  <img src="{{ $reading->image}}">
              </div>
            </div>
            <a href="{{url("/courseDetails/{$reading->id}")}}">Resume Course <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      @endforeach 
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="title">
      <h4>Video Courses</h4>
    </div>
    <div class="video-courses">
      @foreach($videoCourcesArr as $videoCource)
        <div>
          <div class="courses-box">
            <div class="head">
              <img src="{{ $videoCource->image }}">
            </div>
            <div class="row">
              <h4><a href="{{url("/courseDetails/{$videoCource->id}")}}">{{ $videoCource->name }}</a></h4>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="course-slider-detail">
                  <span>Duration</span>
                  <b>{{ $videoCource->duration }}</b>
                </div>
                <div class="course-slider-detail">
                  <span>Books</span>
                  <b>NA</b>
                </div>
              </div>
               <div class="col-6">
                <div class="course-slider-detail">
                  <span>Skill Level</span>
                  <b>{{ $videoCource->skill->name }}</b>
                </div>
                <div class="course-slider-detail">
                  <span>Training Mode</span>
                  <b>{{ $videoCource->trainnig_mode }}</b>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="title">
      <h4>Books</h4>
    </div>
    <!-- <a href="#" class="view-all-link">View All</a> -->
    <div class="books">
      @foreach($ebooksArr as $ebook)
        <div>
          <div class="courses-box">
            <div class="head">
              <img src="{{ $ebook->image }}">
            </div>
            <div class="row">
              <h4><a href="{{url("/bookDetails/3/{$ebook->id}")}}"> {{ $ebook->title }}</a></h4>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="course-slider-detail">
                  <span>Price</span>
                  <b><i class="fa fa-inr" aria-hidden="true"></i> {{ $ebook->price }}</b>
                </div>
              </div>
               <div class="col-6">
                <div class="course-slider-detail">
                  <span>PDF</span>
                  <b><a href="{{ $ebook->ebook }}">View</a></b>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="title">
      <h4>Mock Test</h4>
    </div>
    <div class="mock-test">
      @foreach($mockTestArr as $mockTest)
        <div>
          <div class="courses-box">
            <div class="head">
              <img src="{{ $mockTest->image }}">
            </div>
            <div class="row">
              <h4><a href="{{url("/testSets/{$mockTest->id}")}}">{{ $mockTest->title }}</a></h4>
              <div class="col-6">
                <div class="course-slider-detail">
                  <span>Question</span>
                  <b>{{ $mockTest->number_of_questions }}</b>
                </div>
              </div>
               <div class="col-6">
                <div class="course-slider-detail">
                  <span>Mock Exam</span>
                  <b>{{ $mockTest->mock_exam }}</b>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@include("footer")

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
<script type="text/javascript">
$('.course-slider').slick({
  infinite: false,
  slidesToShow: 4,
  slidesToScroll: 1,
   arrows: true,
   speed: 300,
   responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
$('.video-courses').slick({
  infinite: false,
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: true,
  speed: 300,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
$('.books').slick({
  infinite: false,
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: true,
  speed: 300,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
$('.mock-test').slick({
  infinite: false,
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: true,
  speed: 300,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
</script>
<script type="text/javascript">
  $(".open-sub-menu").click(function(){
    $(".sub-sidedrawer").toggleClass("active");
  });
  $(".close-sub-sidedrawer").click(function(){
    $(".sub-sidedrawer").removeClass("active");
  });
</script>