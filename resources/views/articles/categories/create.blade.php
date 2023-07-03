@extends('layouts.admin')
@section('title')
    اضافة قسم
@endsection
@section('content')
    <div class="container-fluid pt-3">

        <div class="card shadow-sm">
            <div class="card-header bg-dark">
                اضافة قسم
            </div>
            <div class="card-body">
                <form action="{{ Route('admin.articles-categories.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>العنوان</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>الوصف</label>
                        <textarea class="form-control" name="description" cols="10" rows="5">
                            {{ old('description') }}
                        </textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">
                            اضافة</button>
                    </div>

            </div>
            </form>
        </div>
    </div>
@endsection