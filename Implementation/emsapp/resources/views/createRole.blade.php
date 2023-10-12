{{-- Created by Uros Kozic 2020-0267 --}}
@extends('templateDefined')




@section('mainContent')
<section class="container">
    <h1>Create Role</h1>
    <form action="{{ route('createRoleSubmited')}}" method="POST" class="form">
        @csrf
        <div class="input-box">
          <label>Role Name</label>
          <input type="text" name="name" placeholder="Enter Role Name" required />
        </div>
        <div class="column">
            <a class="cancel-button" href="{{route('roleOverview')}}">Cancel</a>
            
            <button class="create-button" type="submit">Create</button>
        </div>
    </form>
    {{-- <div>{{auth()->user()->idemployee}}</div> --}}
</section>


@endsection