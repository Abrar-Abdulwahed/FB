@extends('layouts.layout')
@section('content')
@section('title')
تسجيل حساب جديد
@endsection
<div class="container">
    <div class="row justify-conten-center col-md-12 col-sm-12">
        <form class="" method="POST" action="{{ route('register') }}">
            @csrf
            <section class="vh-1 00 gradient-custom">
                <div class="contai ner py -5 h-1 00">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card text-dark" style="background-color:#ECEFF4 ; border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                    
                                    <div class="mb-md-2 mt-md-4 pb-5">
                        
                                        <h2 class="fw-bold mb-2 text-uppercase">تسجيل حساب جديد</h2>
                                        <p class="text-dark-50 mb-5">انشاء حساب جديد</p>
                        
                                        <div class="d-flehhx justify-con tent-center text-center mt-4 pt-1">
                                            <button class="btn btn-primary mx-2 px-2" style="background-color: #3b5998;" href="#!" role="button">
                                                <i class="fab fa-facebook-f mx-2 "></i> تسجيل الدخول عن طريق الفيسبوك
                                            </button>
                                            <br>
                                            <button class="btn btn-primary mt-2" style="background-color: #dd4b39;" href="#!" role="button">
                                                <i class="fab fa-google mx-2 px-2"></i>تسجيل الدخول عن طريق جوجل
                                            </button>
                                        </div>
                                

                                        <p class="mt-3">أو</p>

                                        <div class="form-outline form-dark mb-3">
                                            <input type="text" name="name" class="form-control py-2" name="name" value="{{ old('name') }}" placeholder="الاسم" required />
                                            <label class="form-label" for="name"></label>
                                        </div>

                                        <div class="form-outline form-dark mb-3">
                                            <input type="email" class="form-control py-2" name="email" value="{{ old('email') }}" placeholder="البريد الالكتروني " required />
                                            <label class="form-label" for="email"></label>
                                        </div>
                        
                                        <div class="form-outline form-dark mb-3">
                                            <input type="password" class="form-control py-2" name="password" placeholder="كلمة المرور" required />
                                            <label class="form-label" for="password"></label>
                                        </div>

                                        <div class="form-outline form-dark mb-3">
                                            <input type="password" class="form-control py-2" name="password_confirmation" placeholder="تأكيد كلمة المرور" required />
                                            <label class="form-label" for="confirm"></label>
                                        </div>
                        
                                        <p class="small mb-5 pb-lg-2"><a class="text-dark-50" href="#!">هل نسيت كلمة المرور ؟</a></p>
                        
                                        <button class="btn btn-dark btn-lg px-5" type="submit">تسجيل</button>
                                    
                        
                                    </div>
                    
                                    <div class="mt-0">
                                        <p class="mb-0">هل تملك حساب بالفعل؟ <a href="#!" class="text-dark-50 fw-bold">تسجيل الدخول</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
          {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
