@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('admin/CMS/Blog/Category/article_category.pages.index') }}
@endsection
<a href={{ route('admin.articles-categories.create') }} class="btn btn-info float-left my-2"> <i
        class="fa-solid fa-plus"></i>
        {{ __('admin/CMS/Blog/Category/article_category.pages.create') }}</a>
<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        {{ __('admin/CMS/Blog/Category/article_category.pages.index') }}
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>{{ __('admin/CMS/Blog/Category/article_category.fields.title') }}</th>
                    <th>{{ __('admin/CMS/Blog/Category/article_category.fields.slug') }}</th>
                    <th>{{ __('admin/CMS/Blog/Category/article_category.extra.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                    <tr>
                        <td>{{ $category->index + 1 }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }} </td>
                        <td>
                            <a href="{{ route('admin.articles-categories.edit', $category->id) }}"
                                class="mx-1 btn btn-success"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-delete-{{ $category->id }}">
                                <i class="fas fa-trash p-2"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $category->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">{{ __('admin/CMS/Blog/Category/article_category.extra.confirm_delete') }}</p>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>{{ __('admin/CMS/Blog/Category/article_category.extra.Are you sure you want delete this item') }}</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md"
                                                data-dismiss="modal">{{ __('admin/CMS/Blog/Category/article_category.extra.close') }}</button>
                                            <form
                                                action="{{ route('admin.articles-categories.destroy', $category->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark btn-md">{{ __('admin/CMS/Blog/Category/article_category.extra.yes') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
@endsection
