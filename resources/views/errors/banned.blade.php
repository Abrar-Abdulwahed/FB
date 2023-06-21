@extends('layouts.layout')
@section('content')
@section('title')
     خطأ 
@endsection
<div>
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
            <strong>Error !</strong> {{ session('error') }}
        </div>
    @endif
</div>

@endsection