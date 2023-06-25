@extends('layouts.admin')
@section('title', 'تحرير رسائل مخصصة')
@section('content')
    <a href={{ route('admin.custom-message.index') }} class="btn btn-info float-right mb-2">جميع الرسائل المخصصة</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            تحرير رسالة مخصصة
        </div>
        <div class="card-body">
            <form id="quickForm" method="POST" action={{ route('admin.TicketsCategory.update', $category) }}>
                @method('PUT')
                @csrf

                </div>
                <div class="form-group">
                    <label for="name">اسم النوع</label>
                    <input class="form-control" id="text" name="name" placeholder="اكتب الاسم هنا" value="{{$category->name}}">
                    @error('name')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">تعديل</button>
            </form>
        </div>
    </div>
@endsection
