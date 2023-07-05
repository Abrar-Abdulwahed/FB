@extends('layouts.app')
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
