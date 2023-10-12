{{--Created by Nikola Šubarić 2020/0271--}}

@extends('templateDefined')

@section('pageJS')
@endsection

@section('additionCSS')

<link rel="stylesheet" href="{{ asset('css/nikola.css') }}">
<script language="JScript"></script>
<script src="{{ asset('js/nikola.js') }}"></script>
@endsection

@section('mainContent')
    

<div id="main" class="container">
    <h1>Create Account</h1>
    <div class="profile">
        <form id="idForma" action="{{route("createAccountSubmit")}}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            
            <div class="profilePicDiv mx-auto">
                <img src="{{url("img/user.png")}}" id="photo" class="circle">
                <input type="file" id="picForAcc" name="picture" required>
                <label for="picForAcc" id="uploadBtn"> Choose photo </label>
            </div>
            @if (session('image'))
                <span>
                    <font color="red"> {{session('image')}} </font>
                </span>
            @endif
                    
            <div class="input-box">
                <label>Name</label>
                <input id="name" type="text" placeholder="Name" required name="name"/>
            </div>
        
            <div class="input-box">
                <label>Last name</label>
                <input id="lastName" type="text" placeholder="lastName" required name="lastName"/>
            </div>


            <div class="input-box">
                <label>Birth date</label>
                <input id="datePickerId" type="date" placeholder="Enter date" required name="birthday"/>
            </div>


            <div class="input-box">
                <label>Department</label>
                <input id="department" type="text" placeholder="Enter department" required name="department"/>
            </div>
        
        
            <div class="input-box">
                <label>Role</label>
                <br>
                <select id="role" class="select-box" name="role">
                    @foreach($roles as $role)
                    <option selected>{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="input-box">
                <label>Email</label>
                <input id="email" type="text" placeholder="Enter email" name="email"/>
                <span id="emailMess">
                    
                </span>
                @if (session('status'))
                    <span>
                        <font color="red"> {{session('status')}} </font>
                    </span>
                @endif
            </div>
        
            <div class="input-box">
                <input id="check" name="cA" type="text" hidden>
                <label>Password</label>
                <input id="pass" type="password" required name="password"/>
                <span id="passMess">
                    
                </span>
            </div>
        
            <div class="input-box">
                <label>Confirm password</label>
                <input id="confPass" type="password" required name="confirmPassword"/>
                
                <span id="confPassError">
                    
                </span>
            </div>  
                
            
            
            <div class="column">
                <input id="sub" class="create-button" type="submit" left="300"/>
                <a class="cancel-button" href="{{route('allEmployees')}}">Cancel</a>
            </div>
            
        </form>
    </div>
</div>


@endsection