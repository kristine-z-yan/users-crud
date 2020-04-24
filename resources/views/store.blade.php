@extends('layouts.app')
@section('content')
    <a href="{{route('users.index')}}" class="btn btn-info">< Go Back</a>
    <h2>Add New User</h2>
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" class="form-control" name="first_name" placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" class="form-control" name="last_name" placeholder="Last Name">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <select class="form-control" id="country" name="country_id">
                <option value="0" disabled selected>Select Country</option>
                @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="roles">Roles</label>
            <select class="form-control" id="roles" name="roles" multiple>
                <option value="0" disabled selected>Select Role/Roles</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}: {{$role->description}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group text-right">
            <button type="button" id="create-user" class="btn btn-success">Create</button>
        </div>
    </form>
@endsection('content')
