@include("header")
<?php
  $ActivePlan = '';
  $userFields = Session::get('users');
  $usertoken = session::get('userstoken');
  $RazorKey = 'rzp_test_zjvgvnieuRQsT6';
  $isActivePlan = false;
  $UserId = $userFields['id'];
  $ActivePlanArr = $userFields['active_plan'];
  $TotalSizeOfAct = count($ActivePlanArr);
  if($TotalSizeOfAct > 0){
    $ActivePlan = $ActivePlanArr['plan'];
    $isActivePlan = true;
  }
  $StartDate = date("Y-m-d");
  $EndDate = date('Y-m-d', strtotime($StartDate. ' + 30 days'));
?>
<div class="membership-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-6 col-lg-7">
        <h5>Become a Member</h5>
        <div class="row">
          <div class="col-lg-4 col-md-4">
            <div class="membership-plan free">
              <div class="icon"><img src="img/room.svg"></div>
              <h2><i class="fa fa-inr" aria-hidden="true"></i> 0</h2>
              <small>Per Month</small>
              <h6>Free</h6>
              <p>Access 1 Mock Test at No Cost</p>
              @if($isActivePlan == false)
                <button class="button">Enroll now</button>
              @else
                <button class="button">Other Plan Active</button>
              @endif
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="membership-plan silver">
              <div class="icon"><img src="img/rocket.svg"></div>
              <h2><i class="fa fa-inr" aria-hidden="true"></i> 1999</h2>
              <small>Per Month</small>
              <h6>Silver</h6>
              <p>Access 5 Mock Test with any 2 Course</p>
              @if($ActivePlan == 'Silver')
                <button class="button">Active</button>
              @elseif($ActivePlan == 'Gold')
                <button class="button">Other Plan Active</button>
              @else
                <button class="button buy_now" data-amount="1999" data-id="2" data-plan="Silver">Enroll now</button>
              @endif
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="membership-plan gold">
              <label>BEST</label>
              <div class="icon"><img src="img/briefcase.svg"></div>
              <h2><i class="fa fa-inr" aria-hidden="true"></i> 3999</h2>
              <small>Per Month</small>
              <h6>Gold</h6>
              <p>Access 10 PMP Mock Test with any 3 Course</p>
              
              @if($ActivePlan == 'Gold')
                <button class="button">Active</button>
              @elseif($ActivePlan == 'Silver')
                <button class="button">Other Plan Active</button>
              @else
                <button class="button buy_now" data-amount="3999" data-id="3" data-plan="Gold">Enroll now</button>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-5">
        <img src="img/membership-img.svg" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<div class="membership-content">
  <div class="container">
    <h5>Terms & Conditions</h5>
    <p>We have multiple membership option to suit your Unique Learning needs. Change or Upgrade at Any time and Learn at your own pace.</p>
  </div>
</div>

<!-- <div class="membership-content">
  <div class="container">
    <h5>Retiree Membership</h5>
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
  </div>
</div> -->

@include("footer")
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var SITEURL = '{{URL::to('')}}';
var API_URL = '{{config("app.api_url")}}'+'post-transaction';

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
}); 
$('body').on('click', '.buy_now', function(e){
  var totalAmount = $(this).attr("data-amount");
  var RAZOR_KEY = "{{ $RazorKey }}";
  var product_id =  $(this).attr("data-id");
  var planName =  $(this).attr("data-plan");
  var fullName = "{{ $userFields['name'] }}";
  var mobile_number = "{{ $userFields['mobile_number'] }}";
  var options = {
                  "key": RAZOR_KEY,
                  "amount": (totalAmount*100), // 2000 paise = INR 20
                  "name": planName,
                  "description": "",
                  "image": "",//"{{asset('img/logo.svg')}}",
                  "handler": function (response){
                    // window.location.href = SITEURL +'/'+ 'paysuccess/'+response.razorpay_payment_id+'/'+totalAmount+'/'+product_id;
                    var settings = {
                      "url": API_URL,
                      "method": "POST",
                      "timeout": 0,
                      "headers": {
                        "Accept": "application/json",
                        "Authorization": "Bearer " + '{{ $usertoken }}',
                        "Content-Type": "application/json"
                      },
                      "data": JSON.stringify({ "transaction_id": response.razorpay_payment_id, "plan": product_id, "start_date": "{{ $StartDate }}", "end_date": "{{ $EndDate }}", "amount": totalAmount, "user_id": "{{ $UserId }}" }),
                    };

                    $.ajax(settings).done(function (response) {
                        // console.log(response);
                        var stringifyJson = JSON.stringify(response);
                        var responseData = JSON.parse(stringifyJson);
                        var isSuccess = responseData.success;
                        var message = responseData.message;

                        if (isSuccess == true) {
                            window.location.href = SITEURL+'/thankYou';
                        }
                    });
                  },
                  "prefill": {
                    "contact": mobile_number,
                    "email":   '',
                  },
                  "theme": {
                    "color": "#eeb01c"
                  }
                };
  var rzp1 = new Razorpay(options);
  rzp1.open();
  e.preventDefault();
});
/*document.getElementsClass('buy_plan1').onclick = function(e){
rzp1.open();
e.preventDefault();
}*/
</script>