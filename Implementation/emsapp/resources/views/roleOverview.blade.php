{{--created by Uros Kozic 2020-0267 --}}
@extends('templateDefined')


@section('mainContent')


<section class="container">
    <h1>All Roles</h1>
    <a class="button-create" href="{{ route('createRole')}}">Add new role</a>

    @foreach ($roles as  $role)
        <div class="role-card">
            <div class="role-header">
                Role Id: {{$role->idrole}}
            </div>
            <div class="role-body">
                <h3 class="role-title">{{$role->name}}</h5>
            </div>
        </div>
    @endforeach
    
</section>

@endsection