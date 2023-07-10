@extends('layouts.guest')
@section('content')
@section('title')
    تسجيل حساب جديد
@endsection
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 bg-white p-3 col-11 rounded-top">
            <div class="form-header py-lg-4 px-lg-4 pb-3 shadow-sm">
                <div class="row align-items-end justify-content-center col-md-12">
                    <div class="line col-md-6 ol-sm-10 text-center mb-3 pt-lg-3">
                        <h4>إنشاء حساب جديد</h4>
                    </div>
                    {{--  <div class="row justify-content-center align-items-center mb-3">
                            <button type="button" class="btn btn-primary col-lg-5 col-sm-11 mx-2 mb-2 "> بإستخدام مايكروسوفت<i class="fa-brands fa-windows px-2"></i></button>
                            <button type="button" class="btn btn-danger col-lg-5 col-sm-11 mx-2 mb-2 "> بإستخدام جوجل<i class="fa-brands fa-google px-2"></i></button>
                        </div>  --}}
                    @include('components.app_login')
                </div>
                @feature('register')
                    <form method="POST" action="{{ route('register') }}"
                        class="form-content text-end col-md-12 justify-content-center px-lg-4">
                        @csrf
                        <div class="row align-items-end justify-content-center px-3">


                            <label for="name" class="col-sm-11 col-lg-10 text-end fs-6 fw-bold">الاسم<br>
                                <input type="text"name="name" value="{{ old('name') }}" placeholder=" الاسم "
                                    id="name" class="border w-100 py-2 px-2 my-1 text-end fs-6 rounded mt-3 mb-3">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </label>


                            <label for="email" class="col-sm-11 col-lg-10 text-end py-1 fs-6 fw-bold">البريد
                                الالكترونى<br>
                                <input type="text"name="email" value="{{ old('email') }}"
                                    placeholder="البريد الالكتروني " id="email"
                                    class="border w-100 py-2 px-2 my-1 text-end fs-6 rounded mt-3 mb-3">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </label>

                            <label for="password" class="col-sm-11 col-lg-10 text-end py-1 fs-6 fw-bold">كلمة المرور<br>
                                <input type="password" name="password" placeholder="كلمة المرور" id="password"
                                    class="border w-100 py-2 px-2 my-1 text-end fs-6 rounded mt-3 mb-3">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </label>

                            <label for="password_confirmation" class="col-sm-11 col-lg-10 text-end py-1 fs-6 fw-bold">
                                تاكيد
                                كلمة المرور<br>
                                <input type="password" name="password_confirmation" placeholder="تأكيد كلمة المرور"
                                    id="password_confirmation"
                                    class="border w-100 py-2 px-2 my-1 text-end fs-6 rounded mt-3 mb-3">
                                @error('password_confirmation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </label>

                            <div class="col-lg-10 col-sm-12 text-lg-end text-center mt-3 mb-2 pt-md-2">
                                <input type="checkbox" name="terms">
                                <label class="px-2">هل توافق على شروط الخدمة</label><br>
                            </div>
                            @error('terms')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            @feature('captcha')
                                <div class="text-center">
                                    <div style="display: inline-block"> {!! htmlFormSnippet() !!} </div>
                                    @error('g-recaptcha-response')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endfeature
                            <div class="d-flex justify-content-center m-3">
                                <button type="submit" class="btn btn-dark btn-lg px-5">تسجيل الدخول</button>
                            </div>

                            <div class="text-center m-3">
                                <p class="mb-0 text-center">هل تملك حساب بالفعل؟<a href="{{ route('login') }}"
                                        class="text-primary-50 fw-bold">تسجيل الدخول</a>
                                </p>
                            </div>
                    </form>
                @else
                    <div class="alert alert-warning" role="alert">
                        التسجيل مغلق مؤقتا
                    </div>
                @endfeature


            </div>
        </div>

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
</div>
@endsection

@push('scripts')
@include('partials.alerts')
@endpush
