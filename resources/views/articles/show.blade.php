@extends('layouts.user')
@section('title')
عرض مقال
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            عرض المقال
        </div>
        <div class="card-body">
            <div>
                title : {{ $article->title }}
            </div>
            <div>
                content : {{ $article->content }}
            </div>
        </div>
    </div>
@endsection

@push('js')
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
@endpush
