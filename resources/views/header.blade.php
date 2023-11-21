<?php
// use Session;
?>
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light header">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('img/logonew.jpeg')}}"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" aria-current="page" href="{{url('/')}}">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('courseList*')) ? 'active' : '' }}" href="{{url('/courseList')}}">Courses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('books*')) ? 'active' : '' }}" href="{{url('/books')}}">Books</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('Tests*')) ? 'active' : '' }}" href="{{url('/Tests')}}">Tests</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('membership*')) ? 'active' : '' }}" href="{{url('/membership')}}">Membership</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Support</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Help</a>
          </li> -->
        </ul>
        <form class="d-flex">
          <i class="bi bi-search"></i>
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        </form>
        @if(Session::get('users'))
          <?php 
          $userFields = Session::get('users');
            ?>
          <div class="profile-menu-right dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ $userFields['profile_photo_path'] }}">
                {{ $userFields['name'] }}
              </a> 
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{url('/userProfile')}}">My Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href=" {{ route('Logout') }}">Logout</a></li>
              </ul>
          </div>
        @endif
      </div>
    </div>
  </nav>