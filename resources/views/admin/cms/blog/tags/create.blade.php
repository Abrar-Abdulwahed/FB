@extends('layouts.admin')
@section('title')
    {{ __('admin/CMS/Blog/Tag/tag.pages.index') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: black;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid pt-3">

        <div class="card shadow-sm">
            <div class="card-header bg-dark">
                {{ __('admin/CMS/Blog/Tag/tag.pages.index') }}
            </div>
            <div class="card-body">
                <form action="{{ Route('admin.tags.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('admin/CMS/Blog/Tag/tag.fields.name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('admin/CMS/Blog/Tag/tag.fields.slug') }}</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary">
                            {{ __('admin/CMS/Blog/Tag/tag.buttons.create') }}</button>
                    </div>

            </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endpush
