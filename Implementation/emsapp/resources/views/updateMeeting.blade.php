{{-- Created by Boris Martinovic 2020/0582 --}}
@extends('templateDefined')

@section('pageJS')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/createMeeting.js') }}"></script>
    <script src="{{ asset('js/updateMeeting.js') }}"></script>
@endsection

@section('mainContent')
    
    <section class="container">
        <h1>Update Meeting: {{$meeting->title}}</h1>
        @if (session('status'))
        <span>
            <font color="red"> {{session('status')}} </font>
        </span>
        @endif
        <form action="{{route('updateMeetingSubmit')}}" method="POST" class="form" id="submitForm">
            @csrf
            <input type="hidden" id="phpTimeFrom" value="{{$meeting->timeFrom}}">
            <input type="hidden" id="phpTimeTo" value="{{$meeting->timeTo}}">
            <input type="hidden" name="idmeeting" id="idmeeting" value="{{$meeting->idmeeting}}">
            <div class="input-box">
                <label>Title</label>
                <input name="title" id="title" value="{{$meeting->title}}" type="text" placeholder="Enter Title" required />
            </div>
            <div class="input-box">
                <label>Date</label>
                <input name="meetdate" id="meetDate" type="date" placeholder="Enter date" required />
            </div>
            <div class="column">
                <div class="input-box">
                    <label>Time From</label>
                    <div class="select-box">
                        <select id="timeFrom" class="timeSelect" name="timeFrom">
                            <option hidden>From</option>
                        </select>
                    </div>
                </div>
                <div class="input-box">
                    <label>Time To</label>
                    <div class="select-box">
                        <select id="timeTo" class="timeSelect" name="timeTo">
                            <option hidden>To</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="input-box">
                <input type="hidden" name="participants" id="participants">
                <label>Participants</label>
                <div class="participant-icon">
                    <img src="{{url("img/".$manager->picture)}}">
                    <div>
                        <span class="participant-name">&nbsp {{$manager->firstName}} {{$manager->lastName}}</span>
                        <br>
                        <span class="participant-email">&nbsp {{$manager->email}}</span>
                        <input type="hidden" class="employees" value="{{$manager->idemployee}}">
                    </div>
                </div>
                @foreach ($meeting->participants as $participant)
                    @if ($participant->idemployee != $manager->idemployee)
                    <div class="participant-icon">
                        <img src="{{url("img/".$participant->picture)}}">
                        <div>
                            <span class="participant-name">&nbsp {{$participant->firstName}} {{$participant->lastName}}</span>
                            <br>
                            <span class="participant-email">&nbsp {{$participant->email}}</span>
                            <input type="hidden" class="employees" value="{{$participant->idemployee}}">
                        </div>
                    </div>
                    @endif
                @endforeach
                <br>
                <a id="addParticipant">
                    <i class='bx bx-plus-circle'></i>
                    <span class="participant-email">&nbsp Add Participant</span>
                </a>
                <div class="input-box" id="inputParticipant" style="display: none;">
                    <div class="column">
                            <div class="searchInputOuter">
                                <input type="text" placeholder="Enter Email" id="emailField"/>
                                <ul id="searchList">
                                    
                                </ul>
                            </div>
                            <div class="searchControlOuter">
                                <a id="listAddBtn" class="add-button">Add</a>
                                <a id="inputCloseBtn" class="cancel-button2">Cancel</a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <a class="cancel-button" href="{{route('allMeetings')}}">Cancel</a>
                <button type="submit" class="create-button" id="submitBtn">Update</button>
            </div>
        </form>
    </section>
@endsection