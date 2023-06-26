@extends('layouts.admin')

@section('title', 'إنشاء نوع تذكره')
{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush --}}
@section('content')
    <a href={{ route('admin.TicketsCategory.index') }} class="btn btn-info float-right mb-2">جميع انواع التذاكر</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
        تعديل نوع تذكره
        </div>
        <div class="card-body">
            <form id="quickForm" method="POST" action={{ route('admin.TicketsCategory.update',$category->id) }}>
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">اسم النوع</label>
                    <input type="text" name="name" class="form-control"   placeholder="ادخل الاسم" value="{{$category->name}}">
                    @error('code')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>


                <button type="submit" class="btn btn-dark">تعديل</button>
            </form>
        </div>
    </div>
@endsection
