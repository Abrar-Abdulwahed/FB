@extends('layouts.admin')
@section('title','تعديل الرابط المختصر')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            تعديل الرابط المختصر
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.short_links.update', $short_link->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>URL</label>
                    <input type="text" name="url" value="{{ $short_link->url }}" class="form-control">
                    @error('url')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" value="{{ $short_link->slug }}" class="form-control">
                    @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">تعديل</button>
            </form>
        </div>
    </div>
@endsection
