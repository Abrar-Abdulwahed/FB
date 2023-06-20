@extends('layouts.admin')
@section('title') 
تعديل بيانات العضو
@endsection
@section('content')
    <div class="container-fluid pt-3">

        <div class="p-4 bg-white">
            <h2>تعديل بيانات العضو</h2>
        
            <form action="{{ Route('users.update',$user->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
            
                    <div class="form-group col-md-12">
                        <label>الاسم</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label>البريد الاكتروني</label>
                        <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">
                            اضافة</button>                     
                    </div>
                        
                </div>
            </form>
        </div>
    </div>
@endsection
