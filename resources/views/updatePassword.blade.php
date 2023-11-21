<?php
$username = Session::get('username');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="img/fav.png" sizes="16x16" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <title>Knowledgewood | Update Password</title>
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
</head>
<body>
<section class="mt-4 mb-4">
  <div class="container">
    <div class="login">
      <div class="row login_box">
        <div class="col-md-12">
          <form method="POST" id="updatePassword-form" name="updatePassword-form" action="{{ route('updatePasswordAftReg.post') }}">
            @csrf
            <div class="p-3 py-5">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-center">Update Password</h4>
              </div>
              @if(session('success'))
                <div class="alert alert-success fade in">
                  {{ session('success') }}
                </div>
              @endif

              @if(session('passWordFormErr'))
                <div class="alert alert-danger fade in">
                  {{ session('passWordFormErr') }}
                </div>
              @endif
              <div class="row mb-3">
                <div class="col-md-12">
                  <input type="password" class="form-control" name="password" placeholder="Password *" value="{{ old('password') }}">
                  @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-12">
                  <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password *" value="{{ old('password_confirmation') }}">
                  @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                  @endif
                </div>
              </div>
              <div class="text-center">
                <input type="hidden" name="page" value="updatePassword">
                <input type="hidden" name="username" value="{{ $username }}">
                <button type="submit" class="button">Save Profile</button>
              </div>
            </div>
          </form>
        </div>
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