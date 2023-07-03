@extends('layouts.admin')
@section('title','اضافة رابط مختصر')
{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: black;
        }
    </style>
@endpush --}}
@section('content')
    <div class="container-fluid pt-3">

        <div class="card shadow-sm">
            <div class="card-header bg-dark">
                اضافة رابط مختصر
            </div>
            @if (session()->has('error'))
                <p class="alert alert-danger">{{ session('error') }}</p>
            @endif
            <div class="card-body">
                <form action="{{ Route('admin.short_links.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>الرابط</label>
                        <input type="text" name="url" value="{{ old('url') }}" class="form-control">
                        @error('url')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                        <small class="form-text text-muted">يمكن تركه فارغا .</small>

                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary">
                            اضافة</button>
                    </div>

            </div>
            </form>
        </div>
    </div>
@endsection

{{-- @push('js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endpush
 --}}