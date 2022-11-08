@extends('layouts.admin')
@section('content')
<h1>Media</h1>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>photo</th>
            <th>Used For</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @if($photos)
        @foreach ($photos as $photo)
        <tr>
            <td>{{$photo->id}}</td>
            <td><a href="{{$photo->name}}"><img height="50" src="{{$photo->name}}" title="{{$photo->name}}"></a></td>
            <td>{{$photo->user ? "User" : "Post" }}</td>
            <td>{{$photo->created_at->diffForHumans()}}</td>
            <td>{{$photo->updated_at->diffForHumans()}}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>



@endsection