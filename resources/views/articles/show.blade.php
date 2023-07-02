@extends('layouts.user')
@section('title')
عرض مقال
@endsection

@section('content')

    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
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

    <div class="card mb-3" style="max-width: 100%;">
        @foreach ($comments as $comment)

        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{ asset('users/'.$comment->user->avatar) }} class="img-fluid rounded-end" alt="...">
            <p class="card-text">{{ $comment->user->name }}</p>
          </div>
          <div class="col-md-8">
            <div class="card-body">
                    <p class="card-text">{{ $comment->comment }}.</p>
              
              <p class="card-text"><small class="text-muted">{{ $comment->created_at->format('d M Y') }}</small></p>
            </div>
          </div>
        </div>
        @endforeach

    </div>

    <form action="{{ Route('admin.comments.store') }}" method="post">
        @csrf
        <div class="row col-12">

         
            <div class="form-group col-12">
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="comment" id="comment" class="form-control">{{ old('comment') }}</textarea>
                @error('comment')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-sm btn-primary">
                    اضف تعليق</button>
            </div>

        </div>
    </form>
@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#comment'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
