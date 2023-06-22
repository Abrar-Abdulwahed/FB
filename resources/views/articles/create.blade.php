@extends('layouts.admin')
@section('title')
    اضافة مقال
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            اضافة مقال جديد
        </div>
        <div class="card-body">

            <form action="{{ Route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row col-12">

                    <div class="form-group col-12">
                        <label>العنوان</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>الوصف</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>المحتوى</label>
                        <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label>الصورة</label>
                        <input type="file" name="image" class="form-control">
                        @error('image')
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

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'),{
                height: '400px'
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
