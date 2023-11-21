@include("header")
<?php
  // print_r($activePlan);
?>

<section class="mt-4 mb-4">
  <div class="container">
    <div class="row userProfile-box">
      <div class="col-md-12">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <h3 class="font-weight-bold mt-2 mb-0">Thank you!</h3>
          
          <div class="pt-5">
            <h5 class="text-success pb-2">Your {{ $activePlan }} plan has been subscribed Successfully</h5>
            <a href="{{url('/')}}" class="button">Go to Dashboard</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@include("footer")