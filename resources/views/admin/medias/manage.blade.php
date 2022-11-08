@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
<style>
    .image-container {
        position: relative;
        text-decoration: none;
    }

    .delete-image-container {
        position: absolute;
        left: 15px;
        top: -75px;
        color: red;
        background-color: white;
        width: 32px;
        text-align: center;
        height: 32px;
        padding-top: 7px;
        border-radius: 50%;
        opacity: 0;
        transition: 0.3s ease;
    }

    .delete-image-container:hover {
        color: white;
        background-color: rgb(71, 71, 71);
    }

    .image-container:hover>.delete-image-container {
        opacity: 100;
        color: rgb(228, 43, 19);
    }

    .delete-image-container i {
        font-size: 15px;
        position: absolute;
        top: 8px;
        right: 9px;
    }

    .delete-btn {
        background-color: transparent;
        border: 0;
        width: 32px;
        height: 32px;
        outline: 0
    }
</style>
@endsection

@section('content')
@if(Session::has('deleted_img_msg'))
<div class="bg-danger">{{session('deleted_img_msg')}}</div>
@endif
<ul id="aniimated-thumbnials">
    @if($photos)
    @foreach ($photos as $photo)
    <a href="{{$photo->name}}" class="image-container" ">
        <div class=" delete-image-container" data-id="{{$photo->id}}">
        <form method="Post" action="/admin/media/{{$photo->id}}">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="delete-btn">
                <i class=" fas fa-trash-alt"></i>
            </button>
        </form>

        </div>
        <img height="200" src="{{$photo->name}}" />
    </a>
    @endforeach
    @endif
</ul>
@endsection

@section('scripts')
<script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script>
    lightGallery(document.getElementById('aniimated-thumbnials'), {
    thumbnail:true
}); 
var photos = document.getElementsByClassName('delete-image-container')
for(i=0; i<photos.length; i++){
    photos[i].addEventListener('click',function (event){
   event.stopPropagation();
});
}
</script>
@endsection