@extends('layouts.admin')
@section('title')
اقسام  الاسئلة الشائعة
@endsection
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            اقسام  الاسئلة الشائعة
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.faqs-categories.update', $category->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">تعديل</button>
            </form>
        </div>
    </div>
@endsection
