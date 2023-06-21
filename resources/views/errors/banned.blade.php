@extends('layouts.layout')
@section('content')
@section('title')
     خطأ 
@endsection
<div>
    
    @if(Auth::user()->is_banned && Auth::user()->datetime == !null)
    <div class="alert alert-danger"> محظور إلى غاية {{Auth::user()->datetime}} </div>
    @else 
    <div .........>محظور للأبد</div>
    @endif
</div>

@endsection