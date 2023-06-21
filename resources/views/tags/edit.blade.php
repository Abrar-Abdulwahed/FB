@extends('layouts.admin')
@section('title') 
 Edit Slug
@endsection
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        Edit Slug  
    </div>
    <div class="card-body">
        <form action="{{ Route('tags.update',$tag->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>الاسم</label>
                <input type="text" name="name" value="{{ $tag->name }}" class="form-control">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>البريد الاكتروني</label>
                <input type="text" name="slug" value="{{ $tag->slug }}" class="form-control">
                @error('slug')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">تعديل</button>
        </form>
    </div>
</div>
@endsection
