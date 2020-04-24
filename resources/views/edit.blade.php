@extends('layouts.app')
@section('content')
    <a href="{{route('users.index')}}" class="btn btn-info">< Go Back</a>
    <h2>Edit User</h2>
    <form action="/" method="post">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" class="form-control" name="first_name" placeholder="First Name" value="{{$user->first_name}}">
        </div>
        <div class="form-group">
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" class="form-control" name="last_name" placeholder="Last Name" value="{{$user->last_name}}">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <select class="form-control" id="country" name="country_id">
                <option value="0" disabled selected>Select Country</option>
                @foreach($countries as $country)
                    @if($user->country->id == $country->id)
                        <option value="{{$country->id}}" selected="true">{{$country->name}}</option>
                    @else
                        <option value="{{$country->id}}">{{$country->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="roles">Roles</label>
            <select class="form-control" id="roles" name="roles" multiple>
                <option value="0" disabled>Select Role/Roles</option>
                @foreach($roles as $role)
                    @if(in_array($role->id, $user_roles))
                        <option value="{{ $role->id }}" selected="true">{{ $role->name }}</option>
                    @else
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group text-right">
            <button type="button" id="edit-user" class="btn btn-success" data-id="{{$user->id}}">Update</button>
        </div>
    </form>
@endsection('content')
