@extends('layouts.admin')
@section('content')
<h1>Category Create</h1>

<form method="POST" action="/admin/categories" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Create Category" class="btn btn-primary">
    </div>
</form>
@include('includes.form_errors')
@endsection