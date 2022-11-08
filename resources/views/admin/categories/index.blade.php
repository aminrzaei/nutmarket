@extends('layouts.admin')
@section('content')
<h1>Categories list</h1>

@if(Session::has('deleted_category_msg'))
<div class="bg-danger">{{session('deleted_category_msg')}}</div>
@endif
@if(Session::has('created_category_msg'))
<div class="bg-success">{{session('created_category_msg')}}</div>
@endif
@if(Session::has('updated_category_msg'))
<div class="bg-primary">{{session('updated_category_msg')}}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @if($categories)
        @foreach ($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
            <td>{{$category->created_at->diffForHumans()}}</td>
            <td>{{$category->updated_at->diffForHumans()}}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

@endsection