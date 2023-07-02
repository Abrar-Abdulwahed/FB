@extends('layouts.admin')
@section('content')
@section('title')
    Article for Category
@endsection
{{-- displat title of each article --}}
@foreach ($articles as $article)
    {{ $article->title }}
    <br>
@endforeach
@endsection
