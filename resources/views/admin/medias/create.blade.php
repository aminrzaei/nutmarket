@extends('layouts.admin')

@section('styles')

<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css"
    rel="stylesheet">


<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js">
</script>
<script
    src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js">
</script>



<style>
    .filepond--root {
        font-size: 1.5em;
    }

    .filepond--drop-label {
        color: #000000;
    }

    .filepond--label-action {
        text-decoration-color: #000000;
    }

    .filepond--panel-root {
        border-radius: 2em;
        background-color: #edf0f4;
        height: 5em;
    }

    .filepond--item-panel {
        background-color: #595e68;
    }

    .filepond--drip-blob {
        background-color: #7f8a9a;
    }
</style>
@endsection

@section('content')

<h1>Upload Media</h1>

<input type="file" class="filepond" name="filepond" multiple data-max-file-size="3MB" data-max-files="3">


@endsection

@section('scripts')

<script>
    FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginFileEncode,
	FilePondPluginFileValidateSize,
	FilePondPluginImageExifOrientation
    );
    FilePond.create(document.querySelector('input[type="file"]'));
    FilePond.setOptions({
    server: '/api/upload/image'
    });
</script>
@endsection