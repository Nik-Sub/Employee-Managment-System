{{-- Created by Boris Martinovic 2020/0582 --}}
@extends('templateDefined')

@section('mainContent')
    <section class="container">
        <h1>Update Attendance for meeting: {{$meeting->title}}</h1>
        <form action="{{route('updateAttendanceSubmit')}}" method="POST" class="form">
            @csrf
            <input type="hidden" name="idmeeting" value="{{$meeting->idmeeting}}">
            <div class="input-box">
                <label>Participants</label>
                <div class="participant-icon column">
                    <img src="{{url("img/".$manager->picture)}}">
                    <div>
                        <span class="participant-name">&nbsp {{$manager->firstName}} {{$manager->lastName}}</span>
                        <br>
                        <span class="participant-email">&nbsp {{$manager->email}}</span>
                    </div>
                    <div class="attendance">
                        <input type="checkbox" name="e{{$manager->idemployee}}"/>
                        <span>Attended</span>
                    </div>
                </div>
                @foreach ($meeting->participants as $participant)
                    @if ($participant->idemployee != $manager->idemployee)
                    <div class="participant-icon column">
                        <img src="{{url("img/".$participant->picture)}}">
                        <div>
                            <span class="participant-name">&nbsp {{$participant->firstName}} {{$participant->lastName}}</span>
                            <br>
                            <span class="participant-email">&nbsp {{$participant->email}}</span>
                        </div>
                        <div class="attendance">
                            <input type="checkbox" name="e{{$participant->idemployee}}"/>
                            <span>Attended</span>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="column">
                <a class="cancel-button" href="{{route('allMeetings')}}">Cancel</a>
                <button class="create-button" type="submit">Update</button>
            </div>
        </form>
    </section>
@endsection