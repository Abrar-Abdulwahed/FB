@extends('layouts.admin')

@section('title', 'إنشاء دور')

@section('content')
    <a href={{ route('custom-message.index') }} class="btn btn-info float-right mb-2">جميع الادوار</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            إنشاء دور
        </div>
        <div class="card-body">
            <form id="quickForm" method="POST" action={{ route('roles.store') }}>
                @csrf
                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="ادخل الاسم"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark">إضافة</button>
            </form>
        </div>
    </div>
@endsection
