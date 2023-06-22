@extends('layouts.admin')
@section('title', 'تحرير رسائل مخصصة')
@section('content')
    <a href={{ route('admin.roles.index') }} class="btn btn-info float-right mb-2">جميع الرسائل المخصصة</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            تحرير دور
        </div>
        <div class="card-body">
            <form id="quickForm" method="POST" action={{ route('admin.roles.update', $role) }}>
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="ادخل الرمز"
                        value="{{ $role->name }}">
                    @error('name')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">تعديل</button>
            </form>
        </div>
    </div>
@endsection
