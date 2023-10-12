{{--Created by Ivan Šobić 2020/0072--}}
@extends('templateDefined')

@section('additionCSS')
  <link rel="stylesheet" href="{{ asset('css/ivan.css') }}">
@endsection

@section('mainContent')
<section class="container">
  <div class="page">
    <div class="profile">
      <div>
        <img class="user-picture" src="{{url("img/".$employee->picture)}}">
      </div>
      <div class="employee-data">
        <div class="text-data">
          <span class="a">Name</span>
          <span class="name">{{$employee->firstName}} {{$employee->lastName}}</span>
          <span class="a">Birthday</span>
          <span class="birth-date">{{$employee->getBirthday()}}</span>
          <span class="a">Department</span>
          <span class="department">{{$employee->department}}</span>
          @if(auth()->user()->idrole == 1)
          <span class="a">Role</span>
          <span class="role">{{$employee->getRoleName()}}</span>
          @endif
          <span class="a">Email</span>
          <span class="username">{{$employee->email}}</span>
        </div>
      </div>
      <div class="buttons">
        @if(auth()->user()->idrole == 1)
        <a class="update-employee" href="{{route('updateAccount', ['id' => $employee->idemployee])}}">Update</a>
        @endif
        <a class="back-button" href="#" onclick="javascript:history.back()">Back</a>
      </div>
    </div>
  </div>
</section>
@endsection