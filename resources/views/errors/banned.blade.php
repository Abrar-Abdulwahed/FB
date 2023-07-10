@extends('layouts.user')
@section('content')
@section('title')
    خطأ
@endsection
<div>

    @if (Auth::user()->is_banned && Auth::user()->banned_until == !null)
        <div class="alert alert-danger"> محظور إلى غاية {{ Auth::user()->banned_until }} </div>
    @else
        <div .........>محظور للأبد</div>
    @endif
</div>

@endsection
