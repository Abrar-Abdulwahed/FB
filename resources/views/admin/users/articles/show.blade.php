@extends('layouts.blog')

@section('title', 'عرض مقالة')
@section('content')
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger" role="alert">{{ session('error') }}</p>
    @endif
    <div class="bg-body-secondary">
        <section id="sec-7" class="mb-5">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-end bg-white">
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
                </div>
            </div>
        </section>

        @auth
            <section id="sec-8" class="my-4">
                <div class="container">
                    <h5 class="text-end">إترك تعليق</h5>

                    <form class="bg-white py-3 px-4" action="{{ Route('articles.comments') }}" method="post">
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


        <section id="sec-9" class="my-4 p-4 bg-white">
            <h3>التعليقات</h3>
            @foreach ($article->comments as $comment)
                <div class="row m-4">
                    <div class="col-md-1 mx-3">
                        <img src="{{ asset('storage/avatars/' . $comment->user->avatar) }}" style="width:50px; height:50px"
                            class="rounded circle">
                        <p class="card-text">{{ $comment->user->name }}</p>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="card-text">{!! $comment->comment !!}</p>

                            <p class="card-text"><small
                                    class="text-muted">{{ $comment->created_at->format('d M Y') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </section>
    </div>

@endsection
