@include("header")
<?php
$ActivePlan = 'Free';
$userFields = Session::get('users');
$gender = $userFields['gender'];
$ActivePlanArr = $userFields['active_plan'];
$TotalSizeOfAct = count($ActivePlanArr);
if($TotalSizeOfAct > 0){
  $ActivePlan = $ActivePlanArr['plan'];
}

$planClass = 'free';
$planIcon = 'room.svg';
$pStr = 'Access 1 Mock Test at No Cost';

if($ActivePlan == 'Silver'){

  $planClass = 'silver';
  $planIcon = 'rocket.svg';
  $pStr = 'Access 5 Mock Test with any 2 Course';

} else if($ActivePlan == 'Gold'){

  $planClass = 'gold';
  $planIcon = 'briefcase.svg';
  $pStr = 'Access 10 PMP Mock Test with any 3 Course';
}
?>
<section class="mt-4 mb-4">
  <div class="container">
    <div class="row userProfile-box">
      <div class="col-md-3 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <img class="rounded-circle mt-5" width="150px" src="{{ $userFields['profile_photo_path'] }}">
          <h5 class="font-weight-bold mt-2 mb-0">{{ $userFields['name'] }}</h5>
          <span class="text-black-50">{{ $userFields['mobile_number'] }}</span>
          <span> </span>
        </div>
        <div class="membership-plan {{ $planClass }}">
          <div class="icon"><img src="img/{{ $planIcon }}"></div>
          <h2>{{ $ActivePlan }} Package</h2>
          <p>{{ $pStr }}</p>
          <small>Monthly Package</small>
          <h5 class="mb-0">Your Package</h5>
        </div>
      </div>
      <div class="col-md-5 border-right">
        <form method="POST" id="profile-form" name="profile-form" action="{{ route('updateUserProfile.post') }}">
          @csrf
          <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Profile Settings</h4>
            </div>
            @if(session('profileFormSuccess'))
              <div class="alert alert-success fade in">
                {{ session('profileFormSuccess') }}
              </div>
            @endif

            @if(session('profileFormErr'))
              <div class="alert alert-danger fade in">
                {{ session('profileFormErr') }}
              </div>
            @endif
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels">Name *</label>
                <input type="text" class="form-control" placeholder="Name" name="fullname" value="{{ $userFields['name'] }}">
                @if ($errors->has('fullname'))
                  <span class="text-danger">{{ $errors->first('fullname') }}</span>
                @endif
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels">Nick Name</label>
                <input type="text" class="form-control" placeholder="Nick Name" name="nickname" value="{{ $userFields['nickname'] }}">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels" style="display: block;">Gender</label>
                <div class="form-check form-check-inline">
                  <label class="form-check-label" for="flexRadioDefault1">
                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male" <?php if($gender == 'male'){ ?> checked="checked" <?php } ?> > Male
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label" for="flexRadioDefault1">
                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="female" <?php if($gender == 'female'){ ?> checked="checked" <?php } ?> > Female
                  </label>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels">Bio</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="bio" rows="3">{{ $userFields['bio'] }}</textarea>
              </div>
            </div>
            <div class="mt-5 text-center">
              <button type="submit" class="button">Save Profile</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-4">
        <form method="POST" id="password-form" name="password-form" action="{{ route('updatePassword.post') }}">
          @csrf
          <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Change Password</h4>
            </div>
            @if(session('passWordFormSuccess'))
              <div class="alert alert-success fade in">
                {{ session('passWordFormSuccess') }}
              </div>
            @endif

            @if(session('passWordFormErr'))
              <div class="alert alert-danger fade in">
                {{ session('passWordFormErr') }}
              </div>
            @endif
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels">Username *</label>
                <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}">
                @if ($errors->has('username'))
                  <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels">Password *</label>
                <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}">
                @if ($errors->has('password'))
                  <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels">Confirm Password *</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                @if ($errors->has('password_confirmation'))
                  <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
              </div>
            </div>
            <div class="mt-5 text-center">
              <input type="hidden" name="page" value="userProfile">
              <button class="button" type="submit">Update Password</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@include("footer")
<script type="text/javascript">
  $(".alert").fadeTo(3000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
  });
</script>