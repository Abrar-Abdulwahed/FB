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
            <div class="form-group row">
                <div class="col-lg-6">
                    <label class="form-label">حالة المستخدم</label>
                    <select name="is_banned" id="select-beast" class="form-control  nice-select  custom-select">
                        <option value="{{ $user->is_banned}}">{{ $user->is_banned}}</option>
                        <option value="true">حظر</option>
                        <option value="false">فك الحظر </option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label>تاريخ فك الحظر</label>
                    <input class="form-control fc-datepicker" name="datetime" placeholder="YYYY-MM-DD"
                        type="text" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success">تعديل</button>
        </form>
    </div>
</div>
@endsection
