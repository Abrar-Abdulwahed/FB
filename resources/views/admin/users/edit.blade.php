@extends('layouts.admin')
@section('title') 
تعديل بيانات العضو
@endsection
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        تعديل بيانات العضو  
    </div>
    <div class="card-body">
        <form action="{{ Route('users.update',$user->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>الاسم</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>البريد الاكتروني</label>
                <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">تعديل</button>
        </form>
    </div>
</div>
@endsection
