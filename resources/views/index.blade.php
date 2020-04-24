@extends('layouts.app')
@section('content')
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage <b>Users</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="users/create" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                    <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                </div>
            </div>
        </div>
        <table id="users-table" class="table table-striped table-hover">
            <thead>
            <tr>
{{--                <th>--}}
{{--                    <span class="custom-checkbox">--}}
{{--                        <input type="checkbox" id="selectAll">--}}
{{--                        <label for="selectAll"></label>--}}
{{--                    </span>--}}
{{--                </th>--}}
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr id="user-{{$user->id}}">
{{--                <td>--}}
{{--                    <span class="custom-checkbox">--}}
{{--                        <input type="checkbox" id="checkbox1" name="options[]" value="{{$user->id}}">--}}
{{--                        <label for="checkbox1"></label>--}}
{{--                    </span>--}}
{{--                </td>--}}
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->country->name}}</td>
                    <td>
                        @foreach($user->roles as $role)
                            {{$role->name}} </br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id)}}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                        <a href="#deleteUserModal" class="delete delete-user" data-toggle="modal" data-id="{{$user->id}}"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="clearfix">
            {{$users->links()}}
        </div>
    </div>

<!-- Delete User Modal HTML -->
<div id="deleteUserModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="button" id="delete-user" class="btn btn-danger" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection('content')
