@extends('layouts.blog')

@section('title', $article->title)
@section('content')
    @if (session()->has('error'))
        <p class="alert alert-danger" role="alert">{{ session('error') }}</p>
    @endif
    <div class="bg-body-secondary">
        <section id="sec-9" class="mb-5">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-center bg-white">
                        <figure class="col-xs-12">
                            <div class="caption mx-3 my-3">
                                <span> {{ $article->created_at->format('d M Y') }} </span>
                            </div>
                            <h3 class="text-center">{{ $article->title }}</h3>
                            <img src="{{ asset('storage/articles/' . $article->image) }}" alt="">

                            <h4>
                                <p> <span class="bold"> {{ $article->description }}</span>
                            </h4>
                            <p class="cont-1">{!! $article->content !!}</p>
                        </figure>
                    </div>
                    <div class="col-sm-12 my-4 bg-white">
                        <div class="row py-4">
                            <div class="col-sm-10">
                                <h4>{{ $article->user->name }}</h4>
                                <p class="text-end"> </p>
                            </div>
                            <div class="col-sm-2">
                                <img
                                src="{{ $article->user->avatar_image }}"
                                    class="w-75 rounded circle"><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if (session()->has('success'))
            <p class="alert alert-success" role="alert">{{ session('success') }}</p>
        @endif
        @auth
            <section id="sec-8" class="my-4">
                <div class="container">
                    <h5 class="text-end">إترك تعليق</h5>

                    <form class="bg-white py-3 px" action="{{ Route('guest.articles.comments') }}" method="post">
                        @csrf

                        <div class="comment row m-4">

                            <div class="comm-area col-lg-12 col-md-12">
                                <label class="area-content" for="area">التعليق </label><br>
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <textarea class="box my-4" name="comment" id="area" cols="105" rows="6"></textarea>
                                @error('comment')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-primary" type="submit">إرسال التعليق</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

        @endauth


        <div class="container" id="comments">
            @if (count($article->comments)>0)
                <div class="row"><h3>التعليقات</h3></div>
                @foreach ($article->comments as $comment)
                    <div class="card mb-3">
                        <div class="row m-4">
                            <div class="col-md-2 col-lg-2">
                                <img src="{{ $comment->user->avatar_image }}" class="mx-2" style="width:50px; height:50px; border-radius: 50%; margin-right: 30% !important">
                                <p class="card-text" style="text-align: center">{{ $comment->user->name }}</p>
                            </div>
                            <div class="card-body col-md-6 col-lg-10">
                                <p class="card-text" style="text-align: right">{!! $comment->comment !!}</p>
                            </div>
                            <p class="card-text"><small class="text-muted">{{ $comment->created_at->format('d M Y') }}</small></p>  
                        </div>
                    </div>
                @endforeach
            @endif   
        </div>
    </div>
@endsection
