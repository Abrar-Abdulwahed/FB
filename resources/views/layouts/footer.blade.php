<?php
use App\Models\Setting;
$settings = Setting::settings();
?>
<section id="sec-2" class="bg-white mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-4 text-end">
                {{--  @foreach ($settings as $setting) --}}
                <img class="img-fluid" src="{{ asset('storage/' . $settings['site_logo']) }}" alt="">
                <div>
                    <p>{{ $settings['site_description'] }}</p>
                </div>
                {{-- @endforeach --}}

                <div class="clearfix my-2">
                    <a class="float-end my-sm-2" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a class="float-end my-sm-2" href="#"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-md-4 col-sm-6">
                <ul>
                    <li>موقع مستقل</li>
                    <li>وظف المستقلين</li>
                    <li>إبدا العمل الحر</li>
                    <li>تصفّح المشاريع</li>
                </ul>
            </div> --}}
            <div class="col-lg-3 col-md-4 col-sm-6">
                <h6 class="text-center text-sm-end">روابط</h6>
                <ul>
                    <li>تجربة رابط</li>
                </ul>
            </div>


        </div>
    </div>
</section>


<footer>
    <div class="container d-md-flex justify-content-between d-sm-block text-sm-center">
        <ul class="d-inline-flex">
            <li><a>اتصل بنا</a></li>
            <li><a>الاسئلة الشائعة</a></li>
            <li><a>شروط الاستخدام</a></li>
            <li><a>ضمان الحقوق</a></li>
        </ul>
        <p class="text-center text-md-start">{{ config('app.name') }} احد مشاريع شركة x</p>
    </div>
</footer>
