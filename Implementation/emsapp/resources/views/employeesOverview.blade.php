{{--Created by Ivan Šobić 2020/0072--}}
@extends('templateDefined')

@section('additionCSS')
  <link rel="stylesheet" href="{{ asset('css/ivan.css') }}">
@endsection

@section('mainContent')
<section class="container">
  <h1>All Employees</h1>
  @if(auth()->user()->idrole == 1)
  <a class="button-create" href="{{route('createAccount')}}">Add new account</a>
  @endif
  <br>
  @if (session('nodelete'))
      <span>
          <font color="red"> {{session('nodelete')}} </font>
      </span>
    @else
      <span>
        <font color="red"> {{""}} </font>
      </span>
    @endif
  <div class="all-profiles">
    @foreach ($employees as $employee)
    <div class="profile">
      <div>
        <img class="user-picture" src="{{url("img/".$employee->picture)}}">
      </div>
      <div class="employee-data">
        <div class="text-data">
          <span class="a">Name</span>
          <span class="name">{{$employee->firstName}} {{$employee->lastName}}</span>
          <span class="a">Email</span>
          <span class="username">{{$employee->email}}</span>
        </div>
      </div>
      <div class="buttons">
        <a class="view-button" href="{{route('viewEmployee', ['id' => $employee->idemployee])}}">View</a>
        @if(auth()->user()->idrole == 1)
        <a class="view-button" href="{{route('updateAccount', ['id' => $employee->idemployee])}}">Update</a>
        <a class="delete-button" href="{{route('deleteAccount', ['id' => $employee->idemployee])}}">Delete</a>
        @endif
      </div>
    </div>
    @endforeach
  </div>
</section>
@endsection