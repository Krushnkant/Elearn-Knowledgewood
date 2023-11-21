<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="img/fav.png" sizes="16x16" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <title>Knowledgewood | Login</title>
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
                        <form action="{{ route('Checkotp') }}" method="POST">
                            @csrf
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-center">Enter OTP</h4>
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
                                        <input type="text" class="form-control" placeholder="OTP" name="otp">
                                        @if ($errors->has('otp'))
                                            <span class="text-danger">{{ $errors->first('otp') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="button mb-3" >Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@include("footer")