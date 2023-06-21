@extends('layouts.admin')
@section('title') 
اضافة عضو
@endsection
@section('content')
    <div class="container-fluid pt-3">

        <div class="card shadow-sm">
            <div class="card-header bg-dark">
                  اضافة عضو جديد
            </div>
            <div class="card-body">
                <form action="{{ Route('users.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>الاسم</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>البريد الاكتروني</label>
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>كلمة المرور</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" name="avatar" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-dark">إضافة</button>
                </form>
            </div>
        </div>
    </div>
@endsection
