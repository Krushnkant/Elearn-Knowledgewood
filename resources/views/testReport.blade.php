@include("header")
<?php 
  $success = $alldata->success;
  $message = $alldata->message;
  $queDataArr = $alldata->data;
  $total_scored = round(rtrim($alldata->total_scored, ' %'), 2).' %';
  $status = $alldata->status;
  $assessment = $alldata->assessment;
  $assessment_campletion_date = date('d/m/Y | h:i:s A', strtotime($assessment->assessment_campletion_date));
  // $assessment = $alldata->assessment;
  // $assessment = $alldata->assessment;
  // $assessment = $alldata->assessment;
  $total_attempt = $alldata->total_attempt;
  $passing_percentage = $alldata->passing_percentage;
  $pdf_download = $alldata->pdf_download;
  $categoryWiseReport = $alldata->categoryWiseReport;

  $passTxtCls = 'text-green';
  if($status == 'Fail'){
    $passTxtCls = 'text-red';
  }
?>

<style type="text/css">
  @keyframes chartjs-render-animation {
    from {
      opacity: .99
    }

    to {
      opacity: 1
    }
  }

  .chartjs-render-monitor {
    animation: chartjs-render-animation 1ms
  }

  .chartjs-size-monitor,
  .chartjs-size-monitor-expand,
  .chartjs-size-monitor-shrink {
    position: absolute;
    direction: ltr;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    pointer-events: none;
    visibility: hidden;
    z-index: -1
  }

  .chartjs-size-monitor-expand>div {
    position: absolute;
    width: 1000000px;
    height: 1000000px;
    left: 0;
    top: 0
  }

  .chartjs-size-monitor-shrink>div {
    position: absolute;
    width: 200%;
    height: 200%;
    left: 0;
    top: 0
  }
</style>

<section class="mt-4 mb-4">
  <div class="container">
    <div class="row">
      <div class="tests-content-body flex-body">
        <div class="d-flex flex-1">
          <div class="tests-content-left">
            <div class="tests-header">
              <h6>Mock Test Report</h6>
              <h5 class="orange-title mb-0">Successfully Finished | Test 1 | Attempt 1</h5>
            </div>
            <div class="tests-body">
              <div class="result">
                <h5>Your Result</h5>
                <ul>
                  <li>
                    <img src="{{ asset('img/thumbs-up-line.svg') }}">
                    <span>Status</span>
                    <span class="{{ $passTxtCls }}">{{ $status }}</span>
                  </li>
                  <li>
                    <img src="{{ asset('img/percent.svg') }}">
                    <span>Percentage Scored</span>
                    <span>{{ $total_scored }}</span>
                  </li>
                  <li>
                    <img src="{{ asset('img/date-line.svg') }}">
                    <span>Assessment Completion Date</span>
                    <span>{{ $assessment_campletion_date }}</span>
                  </li>
                  <li>
                    <img src="{{ asset('img/flag-line.svg') }}">
                    <span>Pass Percentage</span>
                    <span>{{ $passing_percentage }}</span>
                  </li>
                  <li>
                    <img src="{{ asset('img/document-unknown.svg') }}">
                    <span>Assessment Name</span>
                    <span>-</span>
                  </li>
                  <li>
                    <a href="javascript: void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">Process group
                      wise report</a>
                    <!-- <a href="#">Knowledge area wise report</a> -->
                  </li>
                </ul>
                <a href="{{ $pdf_download }}" target="_blank" class="button">Download</a>
              </div>
            </div>
          </div>
          <div class="result-number-box">
            <h6>Questions:</h6>
            <div class="result-label">
              <span class="green">Correct</span>
              <span class="red">Wrong</span>
              <span class="gray">Un-attempted</span>
            </div>
            <div class="result-number">
              <?php
          $que = 1;
        ?>
              @foreach($queDataArr as $queData)
              <?php
            $className = 'green';
            $is_correct = $queData->is_correct;
            if($is_correct == 'incorrect'){
              $className = 'red';
            } else if($is_correct == 'unattempted'){
              $className = 'gray';
            }
            ?>
              <span class="{{ $className }}">{{ $que }}</span>
              <?php 
            $que++
          ?>
              @endforeach
            </div>
          </div>
        </div>
        <div class="content-bottom">
          <!-- <span>Lorem ipsum dolor sit amet, consetetur</span> -->
          <a href="{{url('/')}}" class="button">Back to Dashoard</a>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Process group wise report</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div style="width:100%;">
                <div class="chartjs-size-monitor">
                  <div class="chartjs-size-monitor-expand">
                    <div class=""></div>
                  </div>
                  <div class="chartjs-size-monitor-shrink">
                    <div class=""></div>
                  </div>
                </div>
                <canvas id="canvas" style="display: block; width: 1379px; height: 689px;" width="1379" height="689"
                  class="chartjs-render-monitor"></canvas>
              </div>
              <div class="table-responsive">
                <table class="table reportTable text-center">
                  <thead>
                    <tr>
                      <th></th>
                      <th class="text-left">Process Group</th>
                      <th>Total Questions</th>
                      <th>Correct Questions</th>
                      <th>Percentage Scored</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categoryWiseReport as $categoryReport)
                    <tr>
                      <td><a class="showhr" href="javascript:void(0)"><img src="{{ asset('img/add.png') }}"></a></td>
                      <td class="text-left mainCat">{{ $categoryReport->title }}</td>
                      <td>{{ $categoryReport->totalQuestion }}</td>
                      <td>{{ $categoryReport->correctQuestion }}</td>
                      <td class="catScores">{{ round($categoryReport->scored, 2) }} %</td>
                    </tr>
                    <?php 
                  $categoryArr = $categoryReport->category;
                  ?>
                    @foreach($categoryArr as $category)
                    <tr class="aser" style="display: none;">
                      <td></td>
                      <td class="text-left">{{ $category->name }}</td>
                      <td>{{ $category->totalQuestion }}</td>
                      <td>{{ $category->correctQuestion }}</td>
                      <td>{{ round($category->scored, 2) }} %</td>
                    </tr>
                    @endforeach
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@include("footer")
<script type="text/javascript" src="https://cdn2.hubspot.net/hubfs/476360/Chart.js"></script>
<script type="text/javascript" src="https://cdn2.hubspot.net/hubfs/476360/utils.js"></script>
<script type="text/javascript">
  var cats = $(".mainCat").map(function () { return $(this).html(); }).get();
  var scores = $(".catScores").map(function () { return $(this).html().replace(/[$@%]/g, ''); }).get();
  var passingPerc = '<?php echo $passing_percentage; ?>'.replace(/[$@%]/g, '');
  var config = {
    type: 'line',
    data: {
      labels: cats,
      datasets: [{
        label: passingPerc + '% Passing Percentage',
        backgroundColor: '#FF0000',
        borderColor: '#FF0000',
        fill: false,
        data: [
          passingPerc,
          passingPerc,
          passingPerc
        ],
      }, {
        label: 'Actual Percentage Scored',
        backgroundColor: '#0d6efd',
        borderColor: '#0d6efd',
        fill: false,
        data: scores,

      }]
    },
    options: {
      responsive: true,
      title: {
        display: true,
        text: 'Exam Result Chart'
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Process Group'
          },

        }],
        yAxes: [{
          display: true,
          //type: 'logarithmic',
          scaleLabel: {
            display: true,
            labelString: ''
          },
          ticks: {
            min: 0,
            max: 100,

            // forces step size to be 5 units
            stepSize: 20
          }
        }]
      }
    }
  };
  $(".showhr").click(function () {
    $(this).closest('tr').nextUntil("tr:has(.showhr)").toggle("slow", function () { });
  });
  window.onload = function () {
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myLine = new Chart(ctx, config);
  };

  document.getElementById('randomizeData').addEventListener('click', function () {
    config.data.datasets.forEach(function (dataset) {
      dataset.data = dataset.data.map(function () {
        return randomScalingFactor();
      });

    });

    window.myLine.update();
  });
</script>