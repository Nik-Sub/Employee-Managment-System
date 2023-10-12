{{-- Created by Uros Kozic 2020-0267 --}}
@extends('template')

@section('pageJS')
    <link rel="stylesheet" href="{{ asset('css/uros.css') }}">
    {{-- <link rel="stylesheet" href="../../public/css/uros.css">
    <link rel="stylesheet" href="../../public/css/uros1.css"> --}}
    
@endsection

@section('mainContent')

<body>
    <div class="wrapper">
      <header class = "logo_name"><i class='bx bxl-c-plus-plus icon'></i>EMS</header>
      @if (session('status'))
          <font color='red'> {{session('status')}}</font>
      @endif
      <form name="loginform" action="{{route('loginSubmit')}}" method="POST">
        @csrf
        <div class="field email">
          <div class="input-area">
            <input name="email" type="text" placeholder="Email Address" value="{{old('email')}}">
            <!-- <i class="icon fas fa-envelope"></i> -->
            <i class='icon bx bxs-envelope'></i>
            <!-- <i class="error error-icon fas fa-exclamation-circle"></i> -->
          </div>
          @error('email')
              <font color='red'> {{$message}} </font>
          @enderror
         
        </div>
        <div class="field password">
          <div class="input-area">
            <input name="password" type="password" placeholder="Password">
            <!-- <i class="icon fas fa-lock"></i> -->
            <i class='icon bx bxs-lock-alt' ></i>
            <!-- <i class="error error-icon fas fa-exclamation-circle"></i> -->
          </div>
          @error('password')
              <font color='red'> {{$message}} </font>
          @enderror
          <!-- <div class="error error-txt">Password can't be blank</div> -->
        </div>
        <!-- <div class="pass-txt"><a href="#">Forgot password?</a></div> -->
        <input type="submit" value="Login">
      </form>
    </div>
  </body>







@endsection