{{--Created by Ivan Šobić 2020/0072--}}
@extends('templateDefined')

@section('pageJS')
  <script src="{{ asset('js/meetingsSwitch.js') }}"></script>
@endsection

@section('additionCSS')
  <link rel="stylesheet" href="{{ asset('css/ivan.css') }}">
@endsection



@section('mainContent')
<section class="container">
  <h1>Meetings</h1>
  @if (auth()->user()->idrole == 1 || auth()->user()->idrole == 2)
  <a class="button-create" href="{{route('createMeeting')}}">Add new meeting</a>
  @endif
  <ul class="meet-tab-nav" id="myTab">
    <li class="nav-item">
      <button class="meet-link active" id="upcoming-tab">Upcoming</button>
    </li>
    <li class="nav-item">
      <button class="meet-link" id="held-tab">Held</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="upcoming-tab-pane">
      
      <div class="meetings-page">
        @foreach ($meetings as $meeting)
          @if ($meeting->status == "U")
          <div class="meeting-div">
            <span class="meeting-title">{{$meeting->title}}</span>
            <span class="a">Organizer</span>
            <span class="meeting-organizer">{{$meeting->getOrganizerFullName()}}</span>
            <span class="a">Date</span>
            <span class="meeting-date">{{$meeting->getDate()}}</span>
            <span class="a">Time</span>
            <span class="meeting-time">{{$meeting->getTimeFrom()}}-{{$meeting->getTimeTo()}}</span>
            @if (auth()->user()->idrole == 1 || $meeting->idemployee == auth()->user()->idemployee)
            <div class="meetings-buttons">
              <a class="update-meeting" href="{{route('updateMeeting', ['id' => $meeting->idmeeting])}}">Update</a>
              <a class="delete-meeting" href="{{route('deleteMeeting', ['id' => $meeting->idmeeting])}}">Delete</a>
            </div>
            @endif
            
          </div>
          @endif
        @endforeach
      </div>
    </div>
    <div class="tab-pane fade" id="held-tab-pane">
      <div class="meetings">
        @foreach ($meetings->reverse() as $meeting)
          @if ($meeting->status == "H")
          <div class="meeting-div">
            <span class="meeting-title">{{$meeting->title}}</span>
            <span class="a">Organizer</span>
            <span class="meeting-organizer">{{$meeting->getOrganizerFullName()}}</span>
            <span class="a">Date</span>
            <span class="meeting-date">{{$meeting->getDate()}}</span>
            <span class="a">Time</span>
            <span class="meeting-time">{{$meeting->getTimeFrom()}}-{{$meeting->getTimeTo()}}</span>
            @if ($meeting->getAttendanceStatus() == "Y")
            <span class="meeting-attended">Attended</span>
            @elseif ($meeting->getAttendanceStatus() == "N")
            <span class="meeting-missed">Missed</span>
            @endif
            @if (auth()->user()->idrole == 1 || $meeting->idemployee == auth()->user()->idemployee)
            <div class="meetings-buttons">
              <a class="button-create" href="{{route('updateAttendance', ['id' => $meeting->idmeeting])}}">Update Attendance</a>
            </div>
            @endif
          </div>
          @endif
        @endforeach
        
      </div>
    </div>
  </div>
</section>
@endsection