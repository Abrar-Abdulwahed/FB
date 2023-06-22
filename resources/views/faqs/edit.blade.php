@extends('layouts.admin')
@section('title')
    تعديل الأسئلة الشائعة
@endsection
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            تعديل السؤال
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.faqs.update', $faq->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>عنوان السؤال</label>
                    <input type="text" name="title" value="{{ $faq->title }}" class="form-control">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label> الاجابة</label>
                    <textarea placeholder="{!! $faq->answer !!}" name="answer" id="answer" class="form-control"
                        value="{{ $faq->answer }}">{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">تعديل</button>
            </form>
        </div>
    </div>
@endsection
