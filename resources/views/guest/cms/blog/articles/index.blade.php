@extends('layouts.blog')

@section('title', 'المقالات')

@section('content')
    <!-- Start Section-2 -->
    <section id="sec-2">
        <div class="container">
            <div class="row">
                @foreach ($articles as $article)
                    <figure class="col-lg-6 col-md-12">
                        @if (!empty($article->image))
                            <img src="{{ asset('storage/articles/' . $article->image) }}" alt="">
                        @else
                            <img src="{{ $article->image_default }}" alt="">
                        @endif

                        <figcaption class="ml-0">
                            <div class="caption">
                                <a href="{{ route('guest.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>
                            <div> <span class="bold text-end"> {{ $article->description }} </span>
                                {!! $article->content !!}
                            </div>

                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Section-2 -->
@endsection
