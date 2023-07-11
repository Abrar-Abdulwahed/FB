@extends('layouts.admin')

@push('css')
    <style>
        .span-tag {
            font-size: 11px;
        }
    </style>
@endpush
@section('content')
@section('title')
    {{ __('admin/CMS/Blog/article.pages.index') }}
@endsection
<a href={{ route('admin.articles.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
    {{ __('admin/CMS/Blog/article.pages.create') }}</a>
<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        {{ __('admin/CMS/Blog/article.pages.index') }}
    </div>
    <div class="card-body table-responsive">

        <table class="table table-striped text-center" id="articles">
            <thead>
                <tr>
                    <th>{{ __('admin/CMS/Blog/article.fields.title') }}</th>
                    <th>{{ __('admin/CMS/Blog/article.fields.image') }}</th>
                    <th>{{ __('admin/CMS/Blog/article.fields.tags') }}</th>
                    <th>{{ __('admin/CMS/Blog/article.fields.categories') }}</th>
                    <th>{{ __('admin/CMS/Blog/article.fields.writer') }} </th>
                    <th>{{ __('admin/CMS/Blog/article.extra.actions') }}</th>
                </tr>
            </thead>
            <tbody>

            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td><a target="_blank"
                                href="{{ route('guest.articles.show', $article->slug) }}">{{ $article->title }}</a></td>
                        <td>

                            @if (!$article->image)
                                <img src="{{ $article->image_default }}" alt="{{ $article->title }}" width="70px"
                                    height="70px">
                            @else
                                <img src="{{ asset('storage/articles/' . $article->image) }}"
                                    alt="{{ $article->title }}" width="70px" height="70px">
                            @endif
                        </td>
                        <td>
                            @foreach ($article->tags as $tag)
                                <span class="span-tag bg-warning rounded px-1 w-50">{{ $tag->name }}</span>
                            @endforeach
                        </td>

                        <td>
                            @foreach ($article->categories as $category)
                                <span class="span-tag bg-warning rounded px-1 w-50">{{ $category->title }}</span>
                            @endforeach
                        </td>

                        <td>
                            <img src="{{ $article->user->avatar_image }}" style="width:50px; height:50px"
                                class="rounded circle"><br>
                            {{ $article->user->name }}
                        </td>

                        <td>
                            <a href="{{ route('guest.articles.show', $article->slug) }}" class="mx-1 btn btn-info"><i
                                    class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="mx-1 btn btn-success"><i
                                    class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-delete-{{ $article->id }}">
                                <i class="fas fa-trash p-2"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $article->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">{{ __('admin/CMS/Blog/article.extra.confirm_delete') }}</p>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>{{ __('admin/CMS/Blog/article.extra.Are you sure you want delete this item') }} </p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md"
                                                data-dismiss="modal">{{ __('admin/CMS/Blog/article.extra.close') }}</button>
                                            <form action="{{ route('admin.articles.destroy', $article->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark btn-md">{{ __('admin/CMS/Blog/article.extra.yes') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
            </tbody>
        </table>

    </div>

</div>
@endsection
