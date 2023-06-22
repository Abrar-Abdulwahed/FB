@extends('layouts.admin')
@section('title')
    اضافة مقال
@endsection

@section('content')
    <div class="container-fluid pt-3">
        <div class="clearfix"></div>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p class="mb-0">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="p-4 bg-white">
            <h2>اضافة مقال جديد</h2>

            <form action="{{ Route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row col-12">

                    <div class="form-group col-12">
                        <label>العنوان</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <label>الوصف</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group col-12">
                        <label>المحتوى</label>
                        <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
                    </div>

                    <div class="form-group col-12">
                        <label>الصورة</label>
                        <input type="file" name="image" class="form-control">
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
            .create(document.querySelector('#description'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
