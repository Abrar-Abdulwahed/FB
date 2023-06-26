<div class="d-flehhx justify-con tent-center text-center mt-4 pt-1">
    @if (\App\Models\Setting::where('name', 'facebook_enable')?->first()?->value == 'on')
        <a class="btn btn-primary mx-2 px-2" style="background-color: #3b5998;" href="{{ route('app.login', 'facebook') }}"
            role="button">
            <i class="fab fa-facebook-f mx-2 "></i> تسجيل الدخول عن طريق الفيسبوك
        </a>
        <p class="mt-3">أو</p>
    @endif
    @if (\App\Models\Setting::where('name', 'google_enable')?->first()?->value == 'on')
        <br>
        <a class="btn btn-primary mt-2" style="background-color: #dd4b39;" href="{{ url('/auth/google/redirect') }}"
            role="button">
            <i class="fab fa-google mx-2 px-2"></i>تسجيل الدخول عن طريق جوجل
        </a>
        <p class="mt-3">أو</p>
    @endif
</div>
