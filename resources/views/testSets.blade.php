@include("header")
<?php 
  $testId = $data['id'];
  $testTitle = $data['title'];
  $testDescription = $data['description'];
  $number_of_questions = $data['number_of_questions'];
  $testImage = $data['image'];
  $skill_id = $data['skill_id'];
  $mock_exam = $data['mock_exam'];
  $sets = $data['sets'];
  $skill = $data['skill'];
?>
<section class="mt-4 mb-4">
  <div class="container">
    <div class="row pt-3 pb-3">
      <div class="col-md-6 p-3">
        <img class="" width="100%" src="{{ $testImage }}">
      </div>
      <div class="col-md-6 p-3">
        <div class="title">
          <h3 class="font-weight-bold mt-2 mb-3">{{ $testTitle }}</h3>
        </div>
        <div class="">
          {!! $testDescription !!}
        </div>
      </div>
    </div>
    <div id="sets-row" class="row pt-5">
      <div class="col-md-12">
        <h4>Test Sets</h4>
      </div>
      @foreach($sets as $set)
        <div class="col-xl-3 col-lg-4 col-md-6 sets-rowblock">
          <div class="courses-box">
            <div class="head">
              <h4><a href="{{url("/testQuestions/{$testId}/{$set->setIndex}")}}">{{ $set->title }}</a></h4>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="course-slider-detail">
                  <span>Duration</span>
                  <b>{{ $set->duration }}</b>
                </div>
              </div>
              <div class="col-6">
                <div class="course-slider-detail">
                  <span>Skill</span>
                  <b>{{ $set->skill }}</b>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    <!-- <div class="text-center m-5">
      <div id="spin-loader" class="justify-content-center">
        <div class="spinner-grow text-warning" role="status">
          <span class="sr-only"></span>
        </div>
      </div>
      <h5 class="text-center loading">Loading...</h5>
    </div> -->
  </div>
</section>

@include("footer")
<!-- <script type="text/javascript">
  var paginate = 1;
  var isNextPageAvailable = 1;
  loadMoreData(paginate);
  $(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
      paginate++;
      loadMoreData(paginate);
    }
  });
  function loadMoreData(paginate) {

    if(isNextPageAvailable == 1){
      $.ajax({
          url: '?page=' + paginate,
          type: 'get',
          datatype: 'html',
          beforeSend: function() {
            $('#spin-loader').show();
            $('.loading').show();
          }
      })
      .done(function(data) {
          var data = JSON.parse(data);
          var htmlcontent = data.htmldata;
          isNextPageAvailable = data.isNextPageAvailable;
          if(htmlcontent.length == 0) {
            $('.loading').show();
            $('.loading').html('No more data.');
            return;
          } else {
            $('#spin-loader').hide();
            $('.loading').hide();
            $('#sets-row').append(htmlcontent);
          }
      })
     .fail(function(jqXHR, ajaxOptions, thrownError) {
        alert('Something went wrong.');
     });
    } else {
      $('.loading').show();
      $('.loading').html('No more data.');
    }
  }
</script> -->