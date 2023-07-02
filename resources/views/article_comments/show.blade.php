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

@endsection


