@extends('layouts.admin')
@section('content')
<h1>Edit User {{$user->name}}</h1>
<div class="row">
    <div class="col-sm-3">
        <img src="{{$user->photo ? $user->photo->name : "http://placehold.it/400x400"}}" alt=""
            class="img-responsive img-rounded">
    </div>
    <div class="col-sm-9">
        <form method="POST" action="/admin/users/{{$user->id}}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{$user->email}}">
                <label for=" password">Password:</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="role_id">Role:</label>
                <select name="role_id" class="form-control">
                    @foreach ($roles as $role)
                    <option @if($user->role_id == $role->id) selected @endif value="{{$role->id}}"> {{$role->name}}
                    </option>
                    @endforeach
                </select>

                <label for="is_active">Status:</label>
                <select name="is_active" class="form-control">
                    <option @if($user->is_active == 1) selected @endif value=1>Active</option>
                    <option @if($user->is_active == 0) selected @endif value=0>Not Active</option>
                </select>
            </div>
            <div class="form-group">
                <label for="is_active">Profile Picture:</label>
                <input type="file" name="user_profile">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Edit User" class="btn btn-primary">
            </div>
        </form>
        <form method="POST" action="/admin/users/{{$user->id}}">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <div class="form-group">
                <input type="submit" name="delete" value="Delete User" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>
<div class="row">@include('includes.form_errors')</div>
@endsection