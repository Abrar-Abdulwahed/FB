@extends('layouts.admin')
@section('content')
@section('title')
    Tags
@endsection
{{-- displat title of each article --}}
@foreach ($tag->articles as $article)
    {{ $article->title }}
    <br> 
@endforeach
@endsection