@extends('layouts.admin')
@section('title') 
اضافة عضو
@endsection
@section('content')
    <div class="container-fluid">

        <div class="p-4">
            <h2>اضافة عضو جديد</h2>
        
            <form action="{{ Route('user.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="card">
                        <div class="card-block p-4">
                            <div class="form-group col-md-12">
                                <label>الاسم</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label>البريد الاكتروني</label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label>كلمة المرور</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label>تأكيد كلمة المرور</label>
                                <input type="password" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>  
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Submit</button>                     
                            </div>
                        </div>

                        
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
