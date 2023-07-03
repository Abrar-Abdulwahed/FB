@extends('layouts.auth')
@section('content')
@section('title')
    تسجيل دخول
@endsection
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8 bg-white p-3 col-11 rounded-top">
                <div class="form-header py-lg-4 px-lg-4 pb-3 shadow-sm">
                    <div class="row align-items-end justify-content-center col-md-12">
                        <div class="line col-md-6 ol-sm-10 text-center mb-5 pt-lg-3">
                            <h4>إنشاء حساب جديد</h4>
                        </div>
                        {{--  <div class="row justify-content-center align-items-center mb-3">
                            <button type="button" class="btn btn-primary col-lg-5 col-sm-11 mx-2 mb-2 "> بإستخدام مايكروسوفت<i class="fa-brands fa-windows px-2"></i></button>
                            <button type="button" class="btn btn-danger col-lg-5 col-sm-11 mx-2 mb-2 "> بإستخدام جوجل<i class="fa-brands fa-google px-2"></i></button>
                        </div>  --}}
                        @include('components.app_login')
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="form-content text-end col-md-12 justify-content-center py-lg-4 px-lg-4">
                        @csrf
                        <div class="row align-items-end justify-content-center">

                            <label for="email" class="col-sm-11 col-lg-10 text-end py-1 fs-6 fw-bold">البريد الالكترونى<br>
                                <input type="text"name="email" value="{{ old('email') }}" placeholder="البريد الالكتروني "  id="email" class="border w-100 py-2 px-2 my-1 text-end fs-6 rounded mt-3 mb-3">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            </label>
        
                            <label for="password" class="col-sm-11 col-lg-10 text-end py-1 fs-6 fw-bold">كلمة المرور<br>
                                <input type="password"  name="password" placeholder="كلمة المرور" id="password" class="border w-100 py-2 px-2 my-1 text-end fs-6 rounded mt-3 mb-3">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            </label>
                           
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary px-4 py-2 mt-4 w-25">تأكيد</button>
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@include('partials.alerts')
@endpush
