@extends('layouts.layout')
@section('content')
@section('title')
    تسجيل حساب جديد
@endsection
<div class="container">
    <div class="row justify-conten-center col-md-12 col-sm-12">     
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
                                        <a class="btn btn-primary mx-2 px-2" style="background-color: #3b5998;" href="{{ url('/auth/facebook/redirect') }}" role="a">
                                            <i class="fab fa-facebook-f mx-2 "></i> تسجيل الدخول عن طريق الفيسبوك
                                        </a>
                                        <br>
                                        <a class="btn btn-primary mt-2" style="background-color: #dd4b39;" href="{{ url('/auth/google/redirect') }}" role="a">
                                            <i class="fab fa-google mx-2 px-2"></i>تسجيل الدخول عن طريق جوجل
                                        </a>
                                    </div>
                                    <form class="" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <p class="mt-3">أو</p>

                                        <div class="form-outline form-dark mb-3">
                                            <input type="text" name="name" class="form-control py-2"
                                                @error('name') is-invalid @enderror name="name"
                                                value="{{ old('name') }}" placeholder="الاسم" />
                                            <label class="form-label" for="name"></label>
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-outline form-dark mb-3">
                                            <input type="email" class="form-control py-2" name="email"
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

                                        <div class="form-outline form-dark mb-3">
                                            <input type="password" class="form-control py-2"
                                                name="password_confirmation" placeholder="تأكيد كلمة المرور" />
                                            <label class="form-label" for="confirm"></label>
                                            @error('password_confirmation')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <div style="display: inline-block"> {!! htmlFormSnippet() !!} </div>
                                            @error('g-recaptcha-response')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>                      
                                        
                                        <button class="btn btn-dark btn-lg px-5 mt-4" type="submit">تسجيل</button>
                                    </form>
                    
                                </div>
                                <div class="mt-0">
                                    <p class="mb-0">هل تملك حساب بالفعل؟ <a href="{{ route('login')}}" class="text-dark-50 fw-bold">تسجيل الدخول</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        <script>     
            Swal.fire({
                title: 'Error!',
                text: 'Do you want to continue',
                icon: 'error',
                confirmButtonText: 'Cool'
                })
        </script>
    </div>
</div>
@endsection
