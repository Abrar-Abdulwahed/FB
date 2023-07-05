@extends('layouts.guest')
@section('title')
    استعادة كلمة المرور
@endsection
@section('content')
    <div class="container">
        <div class="row justify-conten-center col-md-12 col-sm-12">
            <form class="" method="POST" action="{{ route('password.update') }}">
                @csrf
                <section class="vh-1 00 gradient-custom">
                    <div class="container py-5 h-1 00">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                <div class="card text-dark" style="background-color:#ECEFF4 ; border-radius: 1rem;">
                                    <div class="card-body p-5 text-center">
                                        <div class="mb-md-2 mt-md-4 py-3">

                                            <h2 class="fw-bold mb-2 text-uppercase"> استعادة كلمة المرور</h2>

                                            <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="form-outline form-dark my-2">
                                                <input type="email" class="form-control py-2" name="email"
                                                    value="{{ $email ?? old('email') }}" placeholder="البريد الالكتروني "
                                                    autocomplete="email" autofocus />
                                                <label class="form-label" for="email"></label>

                                                @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-outline form-dark mb-2">
                                                <input type="password" class="form-control py-2" name="password"
                                                    placeholder="كلمة المرور" autocomplete="new-password" />
                                                <label class="form-label" for="password"></label>
                                                @error('password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-outline form-dark mb-2">
                                                <input type="password" class="form-control py-2"
                                                    name="password_confirmation" placeholder="تأكيد كلمة المرور" />
                                                <label class="form-label" for="confirm"></label>
                                                @error('password_confirmation')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <button class="btn btn-dark btn-lg px-5" type="submit">استعادة كلمة
                                                المرور</button>

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
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-2">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
