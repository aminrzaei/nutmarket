@extends('layouts.admin')

@section('content')
<h1>Comment replies</h1>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
            <th>Post</th>
            <th>Status</th>
            <th><i class="fas fa-trash-alt"></i>Delete</th>

        </tr>
    </thead>
    <tbody>
        @if($commentReplies)
        @foreach ($commentReplies as $replies)
        <tr>
            <td>{{$replies->id}}</td>
            <td>{{$replies->author}}</td>
            <td>{{$replies->email}}</td>
            <td>{{$replies->body}}</td>
            <td><a href="{{route('home.post', $replies->comment->post->id)}}">View Post</a></td>
            <td>
                @if($replies->is_active == 0)
                <form method="POST" action="/admin/replies/{{$replies->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="is_active" value="1">
                    <button type="submit" class="btn btn-info">Approve</button>
                </form>
                @else
                <form method="POST" action="/admin/replies/{{$replies->id}}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="is_active" value="0">
                    <button type="submit" class="btn btn-warning">Undo Approve</button>
                </form>
                @endif
            </td>
            <td>
                <form method="POST" action="/admin/replies/{{$replies->id}}">
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