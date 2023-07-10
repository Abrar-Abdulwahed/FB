@extends('layouts.blog')
@section('title')
    {{ $page->title }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/pages/styles.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300&family=Noto+Serif:wght@300&family=Roboto+Condensed:wght@300&family=Roboto+Slab&display=swap"
        rel="stylesheet">
@endpush

@section('content')
  
    <!-- Start Section-2 -->
    <section id="sec-2">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-center bg-white">
                    <figure class="col-xs-12">
                        <div class="caption mx-3 my-3">
                            <span>{{ $page->created_at->diffForHumans() }}</span>
                            <a href="#">{{ $page->title }}</a>
                        </div>
                        <h3 class=" text-center">{{ $page->title }}</h3>
                        <img src="Images/team-01.png" alt="">
                        {!! $page->content !!}
                    </figure>
                </div>
                <div class="col-sm-12 my-4 bg-white">
                    <div class="row py-4">
                        <div class="col-sm-10">
                            <h4>Lorem ipsum</h4>
                            <p class="text-end">{{ $page->description }}</p>
                        </div>
                        <div class="col-sm-2">
                            <img class="w-75" src="Images/team-02.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section-2 -->

@endsection
