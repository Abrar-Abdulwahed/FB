@extends('layouts.layout')
@section('content')
@section('title')
    تسجيل دخول
@endsection
<div class="container">
    <div class="row justify-conten-center col-md-12 col-sm-12">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <section class="vh-1 00 gradient-custom">
                <div class="contai ner py -5 h-1 00">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card text-dark" style="background-color:#ECEFF4 ; border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <div class="mb-md-2 mt-md-4 pb-5">
                                        <h2 class="fw-bold mb-2 text-uppercase">تسجيل دخول</h2>
                                        <p class="text-dark-50 mb-5">تسجيل الدخول لحسابك</p>
                                        <div class="d-flehhx justify-con tent-center text-center mt-4 pt-1">
                                            <a class="btn btn-primary mx-2 px-2" style="background-color: #3b5998;"
                                                href="{{ url('/auth/facebook/redirect') }}" role="button">
                                                <i class="fab fa-facebook-f mx-2 "></i> تسجيل الدخول عن طريق الفيسبوك
                                            </a>
                                            <br>
                                            <a class="btn btn-primary mt-2" style="background-color: #dd4b39;"
                                                href="{{ url('/auth/google/redirect') }}" role="button">
                                                <i class="fab fa-google mx-2 px-2"></i>تسجيل الدخول عن طريق جوجل
                                            </a>
                                        </div>
                                        <p class="mt-3">أو</p>
                                        <div class="form-outline form-dark mb-3">
                                            <input type="text" class="form-control py-2" name="email"
                                                value="{{ old('email') }}" placeholder="البريد الالكتروني " />
                                            <label class="form-label" for="email"></label>
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-outline form-dark mb-3">
                                            <input type="password" class="form-control py-2" name="password"
                                                placeholder="كلمة المرور" />
                                            <label class="form-label" for="password"></label>
                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <p class="small mb-5 pb-lg-2"><a class="text-dark-50"
                                                href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                        </p>
                                        <button class="btn btn-dark btn-lg px-5" type="submit">تسجيل الدخول</button>
                                    </div>

                                    <div class="mt-0">
                                        <p class="mb-0">ليس لديك حساب <a href="{{ route('register') }}"
                                                class="text-dark-50 fw-bold">إنشاء حساب</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
</div>
@endsection

@push('scripts')
@include('partials.alerts')
@endpush
