@extends('layouts.admin')
@section('title')
    {{ __('admin/CMS/Blog/Category/article_category.pages.edit') }}
@endsection
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/CMS/Blog/Category/article_category.pages.edit') }}
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.articles-categories.update', $category->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>{{ __('admin/CMS/Blog/Category/article_category.fields.title') }}</label>
                    <input type="text" name="title" value="{{ old('title', $category->title) }}" class="form-control">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('admin/CMS/Blog/Category/article_category.fields.slug') }}</label>
                    <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="form-control">
                    @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('admin/CMS/Blog/Category/article_category.fields.description') }}</label>
                    <textarea class="form-control" name="description" cols="10" rows="5">
                        {{ old('description', $category->description) }}
                    </textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">{{ __('admin/CMS/Blog/Category/article_category.buttons.edit') }}</button>
            </form>
        </div>
    </div>
@endsection
