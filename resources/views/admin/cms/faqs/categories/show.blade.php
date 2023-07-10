@extends('layouts.admin')
@section('content')
@section('title')
اقسام  الاسئلة الشائعة
@endsection
{{-- displat title of each article --}}
@foreach ($faqs as $faq)
    {{ $faq->title }}
    <br>
@endforeach
@endsection
