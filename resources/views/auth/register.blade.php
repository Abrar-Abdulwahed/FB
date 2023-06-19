@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-conten-center">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
          
                      <div class="mb-md-5 mt-md-4 pb-5">
          
                        <h2 class="fw-bold mb-2 text-uppercase">تسجيل الدخول</h2>
                        <p class="text-white-50 mb-5">انشاء حساب جديد</p>
          
                        <div class="d-flex justify-content-center text-center mt-4 pt-1">
                            <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg mx-2 px-2"></i></a>
                            <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                        </div>

                        <p class="mt-3">أو</p>

                        <div class="form-outline form-white mb-4">
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="الاسم" />
                            <label class="form-label" for="typeEmailX"></label>
                        </div>

                        <div class="form-outline form-white mb-4">
                          <input type="email" class="form-control form-control-lg" placeholder="البريد الاكتروني" />
                          <label class="form-label" for="typeEmailX"></label>
                        </div>
          
                        <div class="form-outline form-white mb-4">
                          <input type="password" class="form-control form-control-lg" placeholder="كلمة المرور" />
                          <label class="form-label" for="typePasswordX"></label>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <input type="password" class="form-control form-control-lg" placeholder="تأكيد كلمة المرور" />
                            <label class="form-label" for="confirm"></label>
                        </div>
          
                        <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">هل نسيت كلمة المرور ؟</a></p>
          
                        <button class="btn btn-outline-light btn-lg px-5" type="submit">تسجيل</button>
                      
          
                      </div>
          
                      <div>
                        <p class="mb-0">Have an account? <a href="#!" class="text-white-50 fw-bold">تسجيل الدخول</a>
                        </p>
                      </div>
          
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
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
