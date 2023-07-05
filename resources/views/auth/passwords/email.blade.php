@extends('layouts.guest')
@section('content')
@section('title')
    استعادة كلمة المرور
@endsection
<div class="container">
    <div class="row justify-conten-center col-md-12 col-sm-12">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form class="" method="POST" action="{{ route('password.email') }}">
            @csrf
            <section class="vh-1 00 gradient-custom">
                <div class="container py-5 h-1 00">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card text-dark" style="background-color:#ECEFF4 ; border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <div class="mb-md-2 mt-md-4 pb-4">
                                        <h2 class="fw-bold mb-2 text-uppercase"> استعادة كلمة السر</h2>
                                        <div class="form-outline form-dark my-4">
                                            <input type="email" class="form-control py-2" name="email"
                                                value="{{ old('email') }}" placeholder="البريد الالكتروني " />
                                            <label class="form-label" for="email"></label>
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <button class="btn btn-dark col-12 md-4" type="submit">ارسل رابط استعادة كلمة
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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
