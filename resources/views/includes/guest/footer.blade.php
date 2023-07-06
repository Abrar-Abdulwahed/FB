<?php
use App\Models\Setting;
$settings = Setting::settings();
?>
<!-- Start Section-6 -->
<section id="sec-6" class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 text-end">
                <img class="img-fluid" src="{{ asset('storage/' . $settings['site_logo']) }}" alt="">
                <div>
                    <p>{{ $settings['site_description'] }}</p>
                </div>
                <div class="clearfix my-2">
                    <a class="float-end my-sm-2" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a class="float-end my-sm-2" href="#"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
            {{--  <div class="col-lg-2 col-md-3 col-sm-6">
                <h6 class="text-center text-sm-end">مستقل</h6>
                <ul>
                    <li>موقع مستقل</li>
                    <li>وظف المستقلين</li>
                    <li>إبدا العمل الحر</li>
                    <li>تصفّح المشاريع</li>
                </ul>
            </div> --}}
            <div class="col-lg-2 col-md-3 col-sm-6">
                <h6 class="text-center text-sm-end">روابط</h6>
                <ul>
                    <li>تجربة رابط</li>

                </ul>
            </div>


        </div>
    </div>
</section>
<!-- End Section-6 -->


<!-- Start Footer -->
<footer>
    <div class="container d-md-flex justify-content-between d-sm-block text-sm-center">
        <ul class="d-inline-flex">
            @foreach (App\Models\Page::where('is_in_footer', 1)->select('title', 'slug')->get() as $page)
                <li><a href="{{ route('guest.pages.show', $page->slug) }}">{{ $page->title }}</a></li>
            @endforeach
        </ul>
        <p>مستقل احد مشاريع شركة X</p>
    </div>
</footer>
<!-- End Footer -->
