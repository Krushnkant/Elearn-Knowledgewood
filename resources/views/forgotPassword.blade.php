<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="img/fav.png" sizes="16x16" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <title>Knowledgewood | Forgot Password</title>
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
                        <form action="{{ route('forgotPassword') }}" method="POST">
                            @csrf
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-center">Forgot Password?</h4>
                                </div>
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Username">
                                        @if ($errors->has('username'))
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="button" type="submit">Submit</button>
                                    <div class="forgot-password">
                                        Go to <a href="{{ route('Login') }}">LogIn</a>
                                    </div>
                                    <div class="account-bottom-link">
                                        Not a member yet? <a href="{{ route('Register') }}">Create Account</a>
                                    </div>
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