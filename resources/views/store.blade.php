@extends('layouts.app')
@section('content')
    <a href="{{route('index')}}" class="btn btn-info">< Go Back</a>
    <h2>Add New User</h2>
    <form action="{{route('store')}}" method="post">
        @csrf
        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" class="form-control form-single" name="first_name" placeholder="First Name" value="{{old('first_name')}}">
            @if ($errors->has('first_name'))
                <span class="help-block">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" class="form-control form-single" name="last_name" placeholder="Last Name" value="{{old('last_name')}}">
            @if ($errors->has('last_name'))
                <span class="help-block">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">Email address</label>
            <input type="email" class="form-control form-single" id="email" name="email" placeholder="name@example.com" value="{{old('email')}}">
            @if ($errors->has('email'))
                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
            <label for="country">Country</label>
            <select class="form-control form-single" id="country" name="country_id">
                <option value="0" disabled selected>Select Country</option>
                @foreach($countries as $country)
                    <option value="{{$country->id}}" {{old("country_id") == $country->id ? "selected":""}}>{{$country->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('country_id'))
                <span class="help-block">
                <strong>{{ $errors->first('country_id') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
            <label for="roles">Roles</label>
            <select class="form-control form-multiple" id="roles" name="roles[]" multiple>
                @foreach($roles as $role)
                    <option value="{{$role->id}}" {{collect(old('roles'))->contains($role->id) ? 'selected':''}}>{{$role->name}}: {{$role->description}}</option>
                @endforeach
            </select>
            @if ($errors->has('roles'))
                <span class="help-block">
                <strong>{{ $errors->first('roles') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group text-right">
            <button type="sumbit" class="btn btn-success">Create</button>
        </div>
    </form>
@endsection('content')
