@extends('layouts.admin')
@section('title')
    {{ __('admin/CMS/Blog/Category/article_category.pages.create') }}
@endsection
@section('content')
    <div class="container-fluid pt-3">

        <div class="card shadow-sm">
            <div class="card-header bg-dark">
                {{ __('admin/CMS/Blog/Category/article_category.pages.create') }}
            </div>
            <div class="card-body">
                <form action="{{ Route('admin.articles-categories.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('admin/CMS/Blog/Category/article_category.fields.title') }}</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('admin/CMS/Blog/Category/article_category.fields.slug') }}</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('admin/CMS/Blog/Category/article_category.fields.description') }}</label>
                        <textarea class="form-control" name="description" cols="10" rows="5">
                            {{ old('description') }}
                        </textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary">
                            {{ __('admin/CMS/Blog/Category/article_category.buttons.create') }}</button>
                    </div>

            </div>
            </form>
        </div>
    </div>
@endsection
