{{--Created by Nikola Šubarić 2020/0271--}}

@extends('templateDefined')

@section('pageJS')
@endsection

@section('additionCSS')


<link rel="stylesheet" href="{{ asset('css/nikola.css') }}">

<script src="{{ asset('js/nikola.js') }}"></script>
@endsection

@section('mainContent')
    

<div id="main" class="container">
    <h1>Update Account</h1>
    <div class="profile">
        <form id="idForma" action="{{route("updateAccountSubmit", ['idemployee' => $employee->idemployee])}}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            <div class="profilePicDiv mx-auto">
                <img src="{{url("img/".$employee->picture)}}" id="photo" >
                <input type="file" id="picForAcc" name="picture">
                <label for="picForAcc" id="uploadBtn"> Choose photo </label>
            </div>
            @if (session('image'))
                <span>
                    <font color="red"> {{session('image')}} </font>
                </span>
            @endif
            
            <div class="input-box">
                <label>Name</label>
                <input id="name" name="name" type="text" placeholder="Name" value="{{$employee->firstName}}" required />
            </div>
        
        
            <div class="input-box">
                <label>Last name</label>
                <input id="lastName" name="lastName" type="text" placeholder="Last name" value="{{$employee->lastName}}" required />
            </div>
        
    
            <div class="input-box">
                <label>Birth date</label>
                <input id="datePickerId" name="birthday" type="date" placeholder="Enter date" value="{{$employee->birthday}}" required />
            </div>
    
    
            <div class="input-box">
                <label>Department</label>
                <input id="department" name="department" type="text" placeholder="Enter department" value="{{$employee->department}}" required />
            </div>
        
            <div class="input-box">
                <label>Role</label>
                <br>
                <select id="role" name="role" class="select-box">
                    @foreach($roles as $role)
                        @if ($employee->idrole == $role->idrole)
                            <option selected>{{$role->name}}</option>
                        @else
                            <option>{{$role->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="input-box">
                <label>Email</label>
                <input id="email" type="text" placeholder="Enter email" value="{{$employee->email}}" required name="email"/>
                <span id="emailMess">
                    
                </span>
                @if (session('status'))
                    <span>
                        <font color="red"> {{session('status')}} </font>
                    </span>
                @endif
            </div>


            <div class="input-box">
                <label>Old password</label>
                <input id="oldPass" name="oldPass" type="text" value="{{$employee->password}}" />
            </div>    
    
            <div class="input-box">
                <label>New password</label>
                <input id="check" name="uA" type="text" hidden>
                <input id="pass" name="password" type="password"/>
                <span id="passMess">
                    
                </span>
            </div>
            
            <div class="input-box">
                <label>Confirm new password</label>
                <input id="confPass" name="confirmPassword" type="password"/>
                <span id="confPassError">
                    
                </span>
            </div>

            <div class="column">
                <input id="sub" class="create-button" type="submit" left="300"/>
                <a class="cancel-button" href="#" onclick="javascript:history.back()">Cancel</a>
            </div>
                
        </form>
    </div>
</div>


@endsection