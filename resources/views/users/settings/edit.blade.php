@extends('layouts.user')
@section('title', 'إعدادات المستخدم')
@section('content')
<div class="card shadow-sm">
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-error" role="alert">{{ session('error') }}</p>
    @endif
    <div class="card-header bg-dark">
        تعديل بيانات المستخدم
    </div>
    <div class="card-body">
        <form action="{{ Route('settings.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>البريد الاكتروني</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>الصورة</label>
                <input type="file" name="avatar" value="{{ $user->avatar }}" class="form-control">
                @if (!empty($user['avatar']))
                    <img src="{{ asset('users/'.auth()->user()->avatar) }}" style="width:50px; height:50px" class="rounded circle">
                @endif
                @error('avatar')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-outline form-dark mb-2">
                <label>كلمة المرور الحالية</label>
                <input type="password" class="form-control py-2" name="current_password"/>

                @error('current_password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-outline form-dark mb-2">
                <label>كلمة المرور الجديدة</label>
                <input type="password" class="form-control py-2" name="new_password"/>
                <small class="form-text text-muted">اتركه فارغا في حالة لم ترغب في تغيير كلمة المرور.</small>

                @error('new_password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-outline form-dark mb-2">
                <label>تأكيد كلمة المرور </label>
                <input type="password" class="form-control py-2" name="password_confirmation" />
                @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">تعديل</button>
        </form>
    </div>
</div>
@endsection

