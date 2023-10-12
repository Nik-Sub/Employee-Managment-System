{{-- Created by Boris Martinovic 2020/0582 --}}
@extends('templateDefined')

@section('pageJS')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/createMeeting.js') }}"></script>
@endsection

@section('mainContent')
    
    <section class="container">
        <h1>Create Meeting</h1>
        @if (session('status'))
        <span>
            <font color="red"> {{session('status')}} </font>
        </span>
        @endif
        <form action="{{route('createMeetingSubmit')}}" method="POST" class="form" id="submitForm">
            @csrf
            <div class="input-box">
                <label>Title</label>
                <input name="title" id="title" type="text" placeholder="Enter title" required>
            </div>
            <div class="input-box">
                <label>Date</label>
                <input type="date" placeholder="Enter date" name="meetdate" id="meetDate" required>
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
                <div class="participant-icon last">
                    <img src="{{url("img/".$manager->picture)}}">
                    <div>
                        <span class="participant-name">&nbsp {{$manager->firstName}} {{$manager->lastName}}</span>
                        <br>
                        <span class="participant-email">&nbsp {{$manager->email}}</span>
                        <input type="hidden" class="employees" value="{{$manager->idemployee}}">
                    </div>
                </div>
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
                <button type="submit" class="create-button" id="submitBtn">Create</button>
            </div>
        </form>
    </section>

@endsection