@extends('layouts.admin')
@section('content')
@include('includes.editor')
<h1>Edit Post {{$post->name}}</h1>

<div class="row">
    <div class="col-sm-3">
        <img src="{{$post->photo ? $post->photo->name : "http://placehold.it/400x400"}}" alt=""
            class="img-responsive img-rounded">
    </div>
    <div class="col-sm-9">
        <form method="POST" action="/admin/posts/{{$post->id}}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" value="{{$post->title}}">

                <label for="body">Body:</label>
                <textarea name="body" class="form-control">{{$post->body}}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select name="category_id" class="form-control">
                    @foreach ($categoreis as $category)
                    <option @if($post->category_id == $category->id) selected
                        @endif
                        value="{{$category->id}}">{{$category->name}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="post_picture">Post Picture:</label>
                <input type="file" name="post_picture">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Edit Post" class="btn btn-primary">
            </div>
        </form>
        <form method="POST" action="/admin/posts/{{$post->id}}">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <div class="form-group">
                <input type="submit" name="delete" value="Delete Post" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>
<div class="row">@include('includes.form_errors')</div>
@endsection