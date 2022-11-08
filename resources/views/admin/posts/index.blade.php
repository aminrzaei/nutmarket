@extends('layouts.admin')
@section('content')
<h1>Posts list</h1>
@if(Session::has('deleted_post_msg'))
<div class="bg-danger">{{session('deleted_post_msg')}}</div>
@endif
@if(Session::has('created_post_msg'))
<div class="bg-success">{{session('created_post_msg')}}</div>
@endif
@if(Session::has('updated_post_msg'))
<div class="bg-primary">{{session('updated_post_msg')}}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>photo</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Post</th>
            <th>Comments</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @if($posts)
        @foreach ($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td><img height="50" src="{{$post->photo ? $post->photo->name : "http://placehold.it/400x400"}}"></td>
            <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->category->name}}</td>
            <td><a href="{{route('home.post', $post->slug)}}">View Post</a></td>
            <td><a href="{{route('comments.show', $post->id)}}">View Comments</a></td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

{{$posts->render()}}

@endsection