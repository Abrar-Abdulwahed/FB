@extends('layouts.admin')

@section('title', 'إنشاء نوع تذكره')
{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush --}}
@section('content')
@if (isset($success))
<h4><?php echo $success; ?></h4>    
@endif
    <a href={{ route('admin.TicketsCategory.index') }} class="btn btn-info float-right mb-2">جميع تصنيفات التذاكر</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            إنشاء نوع تذكره
        </div>
        <div class="card-body">
            <form id="quickForm" method="POST" action={{ route('admin.TicketsCategory.store') }}>
                @csrf
                <div class="form-group">
                    <label for="code">اسم النوع</label>
                    <input type="text" name="name" class="form-control"  placeholder="ادخل الاسم"
                        value="{{ old('code') }}">
                    @error('code')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>


                <button type="submit" class="btn btn-dark">إضافة</button>
            </form>
        </div>
    </div>
@endsection
