<div class="d-flehhx justify-con tent-center text-center mt-4 pt-1">
    @feature('facebook')
        <a class="btn btn-primary mx-2 px-2" style="background-color: #3b5998;" href="{{ route('app.login', 'facebook') }}"
            role="button">
            <i class="fab fa-facebook-f mx-2 "></i> تسجيل الدخول عن طريق الفيسبوك
        </a>
    @endfeature
    @feature('google')
        <br>
        <a class="btn btn-primary mt-2" style="background-color: #dd4b39;" href="{{ url('/auth/google/redirect') }}"
            role="button">
            <i class="fab fa-google mx-2 px-2"></i>تسجيل الدخول عن طريق جوجل
        </a>
        <p class="mt-3 text-center">أو</p>
    @endfeature
</div>
