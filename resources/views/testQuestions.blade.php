@include("header")

<section class="">
  <div class="container">
    <div class="row tests-content-body flex-body">
      <!-- <div class="d-flex flex-1"> -->
        <div id="quiz" class="">
          <!-- <div class="tests-header" id="quiz-start-screen">
            <div class="text-center">
              <button type="button" id="quiz-start-btn" class="quiz-button button">Start</button>
            </div>
          </div> -->
        </div>
        <!-- <div class="tests-content-right">
          <div class="tests-guideline">
            <h5 class="orange-title mb-3">Guidelines:</h5>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit</p>
          </div>
          <div class="tests-content-timing">
            <a href="#" class="time-stop-btn"><i class="bi bi-pause-circle-fill"></i></a>
            <div class="tests-timing"><img src="{{ asset('img/stop-watch.svg') }}"> <span id="count">8</span> &nbsp; secs remaining</div>
          </div>
        </div> -->
      <!-- </div> -->
      <!-- <div class="content-bottom">
        <button class="button">Submit Test</button>
      </div> -->
    </div>
  </div>
</section>
<input type="hidden" name="set_types" id="set_types" value="{{ isset($setType) ? $setType :"" }}" />
<input type="hidden" name="times" id="stop_timing" value="{{ isset($stop_time) ? $stop_time :"" }}" />

@include("footer")

<script src="{{asset('dist/jquery.quiz-min.js')}}"></script>
<script type="text/javascript">
  var paginate = 1;
  var isNextPageAvailable = 1;
  loadData();
  
  function loadData() {




    // console.log('Test');
    $.ajax({
      url: '?page=1',
      type: 'get',
      datatype: 'JSON',
      beforeSend: function() {
        $('#spin-loader').show();
        $('.loading').show();
      }
    })
    .done(function(data) {
        var setData = $("#set_types").val();
      var data = JSON.parse(data);
      console.log(data);
      var alldata = data.alldata;
      var userId = data.userId;
      var courseId = data.courseId
      var assessmentId = data.assessmentId;
      var apiUrl = data.apiUrl;
      var usertoken = data.usertoken;
      var baseUrl = data.baseUrl;
      var stop_time = data.stop_time;
      var set = setData;
      var questionsAttended = data.questionsAttended || 0;
      var totalQuestions = data.totalQuestions || 0;

      if(alldata.length > 0){
        $('#quiz').quiz({
          //resultsScreen: '#results-screen',
          //counter: false,
          //homeButton: '#custom-home',
          counterFormat: '%current of %total',
          questions: alldata,
          userId: userId,
          courseId: courseId,
          assessmentId: assessmentId,
          apiUrl: apiUrl,
          usertoken: usertoken,
          baseUrl: baseUrl,
          set: set,
          stop_time: stop_time,
          questionsAttended: questionsAttended,
          totalQuestions: totalQuestions,
        });
      } else {

        $(".tests-header").html('<div class="text-center"><h4 class="text-danger">No Data found for Mock Test</h4></div>');

      }

      /*isNextPageAvailable = data.isNextPageAvailable;
      if(htmlcontent.length == 0) {
        $('.loading').show();
        $('.loading').html('No more data.');
        return;
      } else {
        $('#spin-loader').hide();
        $('.loading').hide();
        $('#sets-row').append(htmlcontent);
      }*/
    })
   .fail(function(jqXHR, ajaxOptions, thrownError) {
      alert('Something went wrong.');
   });
  }

  $(document).ready(function(){
    /*$("#quiz-start-btn, #quiz-next-btn").click(function(){
      var count = 90;
      var interval = setInterval(function(){
        document.getElementById('count').innerHTML = count;
        count--;
        if(count === 0){
          
          $( "#quiz-next-btn" ).trigger( "click" );
          // clearInterval(interval);
          count = 90;
          document.getElementById('count').innerHTML = '90';
          // or...
          // alert("You're out of time!");
        }
      }, 1000);
    });*/
  });
</script>