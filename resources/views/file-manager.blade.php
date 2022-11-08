@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection


@section('content')
<h1>File Manager</h1>
<div style="height: 500px;">
    <div id="fm"></div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endsection