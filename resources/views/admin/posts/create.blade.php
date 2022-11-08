@extends('layouts.admin')
@section('content')

<h1>Post Create</h1>

<form method="POST" action="/admin/posts" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control">

        <label for="body">Body:</label>
        <textarea name="body" class="form-control" id="my-textarea"></textarea>
    </div>
    <div class="form-group">
        <label for="category_id">Category:</label>
        <select name="category_id" class="form-control">
            <option disabled selected value>select a Category</option>
            @foreach ($categoreis as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="post_picture">Post Picture:</label>
        <input type="file" name="post_picture">
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Create Post" class="btn btn-primary">
    </div>
</form>
@include('includes.form_errors')
@include('includes.editor')
@endsection