
{{-- Uros Kozic 2020-0267 --}}
@extends('template')


@section('sideNav')
@auth
<div class="sidebar">
    <div class="logo-details">
        <i class='bx bxl-c-plus-plus icon'></i>
        <div class="logo_name">EMS</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
        <li>
        <a href="{{route('viewEmployee', ['id' => auth()->user()->idemployee])}}">
            <i class='bx bx-user' ></i>
            <span class="links_name">Profile</span>
        </a>
        <span class="tooltip">Profile</span>
        </li>
        <li>
        <a href="{{route('allEmployees')}}">
            <i class='bx bxs-user-detail'></i>
            <span class="links_name">Employees</span>
        </a>
        <span class="tooltip">Employees</span>
        </li>
        
        <li>
            <a href="{{route('allMeetings')}}">
                <i class='bx bxs-objects-vertical-bottom'></i>
                <span class="links_name">Meetings</span>
            </a>
            <span class="tooltip">Meetings</span>
        </li>

        @if(auth()->user()->idrole == "1")
        <li>
            <a href="{{route('roleOverview')}}">
                <i class='bx bx-cog'></i>
                <span class="links_name">Roles</span>
            </a>
            <span class="tooltip">Roles</span>
        </li>
        @endif
        
        
        
        <li class="profile-side">
            <div class="profile-details">
            <div class="name_job">
                <div class="name">{{auth()->user()->firstName}} &nbsp {{auth()->user()->lastName}}</div>
                <div class="job">{{auth()->user()->department}}</div>
            </div>
            </div>
            <a href="{{route('logout')}}">
                <i class='bx bx-log-out' id="log_out" ></i>
            </a>
            
        </li>
    </ul>
</div>
@endauth
@endsection