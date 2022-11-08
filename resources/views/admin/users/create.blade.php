@extends('layouts.admin')
@section('content')
<h1>Creat User</h1>

<form method="POST" action="/admin/users" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control">
        <label for="password">Password:</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="role_id">Role:</label>
        <select name="role_id" class="form-control">
            <option disabled selected value>select a Role</option>
            @foreach ($roles as $role)
            <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>

        <label for="is_active">Status:</label>
        <select name="is_active" class="form-control">
            <option disabled selected value>select a Status</option>
            <option value=1>Active</option>
            <option value=0>Not Active</option>
        </select>
    </div>
    <div class="form-group">
        <label for="is_active">Profile Picture:</label>
        <input type="file" name="user_profile">
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Create User" class="btn btn-primary">
    </div>
</form>
@include('includes.form_errors')
@endsection