@extends('layouts.admin')
@section('content')
<h1>Edit Category {{$category->name}}</h1>

<form method="POST" action="/admin/categories/{{$category->id}}" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="name" class="form-control" value="{{$category->name}}">
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Edit Category" class="btn btn-primary">
    </div>
</form>

<form method="POST" action="/admin/categories/{{$category->id}}">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <div class="form-group">
        <input type="submit" name="delete" value="Delete Category" class="btn btn-danger">
    </div>
</form>
@include('includes.form_errors')
@endsection