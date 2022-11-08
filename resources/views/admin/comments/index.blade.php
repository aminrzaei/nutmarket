@extends('layouts.admin')

@section('content')
<h1>Comments</h1>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
            <th>Post</th>
            <th>Replies</th>
            <th>Status</th>
            <th><i class="fas fa-trash-alt"></i>Delete</th>

        </tr>
    </thead>
    <tbody>
        @if($comments)
        @foreach ($comments as $comment)
        <tr>
            <td>{{$comment->id}}</td>
            <td>{{$comment->author}}</td>
            <td>{{$comment->email}}</td>
            <td>{{$comment->body}}</td>
            <td><a href="{{route('home.post', $comment->post->id)}}">View Post</a></td>
            <td><a href="{{route('replies.show', $comment->id)}}">View Replies</a></td>
            <td>
                @if($comment->is_active == 0)
                <form method="POST" action="/admin/comments/{{$comment->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="is_active" value="1">
                    <button type="submit" class="btn btn-info">Approve</button>
                </form>
                @else
                <form method="POST" action="/admin/comments/{{$comment->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="is_active" value="0">
                    <button type="submit" class="btn btn-warning">Undo Approve</button>
                </form>
                @endif
            </td>
            <td>
                <form method="POST" action="/admin/comments/{{$comment->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

@endsection