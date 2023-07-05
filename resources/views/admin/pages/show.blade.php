@extends('layouts.layout')
@section('title')
عرض صفحة
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            عرض الصفحة
        </div>
        <div class="card-body">
            <div>
                title : {{ $page->title }}
            </div>
            <div>
                content : {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection

{{-- @push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush --}}
