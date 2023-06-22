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
        <form action="{{ Route('faqs.update',$faq->id) }}" method="post">
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
                <textarea name="answer" id="answer" class="form-control">{{ old('answer') }}</textarea>
                @error('answer')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">تعديل</button>
        </form>
    </div>
</div>
@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#answer'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
