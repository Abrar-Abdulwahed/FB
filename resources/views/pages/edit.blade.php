@extends('layouts.admin')
@section('title')
    تعديل صفحة
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            تعديل الصفحة
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.pages.update', $page->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row col-12">

                    <div class="form-group col-12">
                        <label>العنوان</label>
                        <input type="text" name="title" value="{{ old('title', $page->title) }}" class="form-control">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>المحتوى</label>
                        <textarea name="content" id="content" class="form-control">{{ old('content', $page->content) }}</textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>الوصف</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description', $page->description) }}</textarea>
                        @error('description')
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

                    <div class="custom-control custom-switch mx-3 mt-2 col-12">
                        <input @checked($page->is_in_footer) type="checkbox" class="custom-control-input" id="is_in_footer" name="is_in_footer">
                        <label class="custom-control-label" for="is_in_footer">في ال footer</label>
                    </div>

                    <div class="custom-control custom-switch mx-3 my-2 col-12">
                        <input @checked($page->is_in_menu)  type="checkbox" class="custom-control-input" id="is_in_menu" name="is_in_menu">
                        <label class="custom-control-label" for="is_in_menu">في القائمة</label>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">
                            تعديل</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

{{-- @push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush --}}
