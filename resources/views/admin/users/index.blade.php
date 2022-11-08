@extends('layouts.admin')
@section('content')
<h1>Users list</h1>
@if(Session::has('deleted_user_msg'))
<div class="bg-danger">{{session('deleted_user_msg')}}</div>
@endif
@if(Session::has('created_user_msg'))
<div class="bg-success">{{session('created_user_msg')}}</div>
@endif
@if(Session::has('updated_user_msg'))
<div class="bg-primary">{{session('updated_user_msg')}}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Activated</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @if($users)
        @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td><img height="50" src="{{$user->photo ? $user->photo->name : "http://placehold.it/400x400"}}"></td>
            <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->is_active == 1 ? "Active" : "Not Active"}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>


@endsection