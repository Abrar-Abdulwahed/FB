<?php
use App\Models\Setting;
use App\Models\ArticleCategory;
$article_categories = ArticleCategory::article_categories();
use App\Models\Page;
$page = Page::active()->get(['title', 'slug']);
?>
<section id="sec-1" class="m-0 p-0">
    <div class="container">
        <nav class="navbar navbar-expand-lg px-0 mx-0">
            <a class="navbar-brand me-auto" href="#">
                <img class="w-50" src="{{ asset('storage/' . $settingService->get('site_logo')) }}" alt="">
            </a>

            <div class="collapse navbar-collapse" id="main">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link p-2 p-lg-3" aria-current="page" href="#">المقدمة</a>
                    </li>
                    @foreach ($page as $page)
                        <li class="nav-item"><a class="nav-link p-2 p-lg-3"
                                href="{{ route('guest.pages.show', $page->slug) }}">{{ $page['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class=" d-md-none d-lg-flex navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            تصنيفات المقالات
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($article_categories as $category)
                                <li><a class="dropdown-item" href="#">{{ $category->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            مستقل
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            التسويق
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            العمل الحر
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            ريادة الاعمال
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>

            @if (Auth::user())
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar2"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="mr-0 ml-auto">
                    <div class="mr-0 ml-auto collapse navbar-collapse" id="navbar2">
                        <ul class=" d-md-none d-lg-flex navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ auth()->user()->avatar_image }}" style="border-radius: 50%"
                                        width="50px" height="50px">
                                    <br>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item"><i class="nav-icon fa-solid fa-user nav-icon"></i><a
                                            href="{{ route('user.profile.edit', auth()->user()->id) }}">البروفايل</a>
                                    </li>
                                    <li class="dropdown-divider"></li>


                                    <li class="dropdown-item"><i class="nav-icon fa-solid fa-newspaper nav-icon"></i><a
                                            href="{{ route('guest.support.faq.index') }}">الأسئلة الشائعة</a></li>

                                    <li class="dropdown-divider"></li>

                                    <li class="dropdown-item"><i class="nav-icon fa-solid fa-plus nav-icon"></i><a
                                            href="{{ route('user.ticket.create') }}">انشاء تذكره</a></li>
                                    <li class="dropdown-divider"></li>


                                    <li class="dropdown-item"><i class="nav-icon fa-solid fa-newspaper nav-icon"></i><a
                                            href="{{ route('user.ticket.index') }}">قائمه التذاكر</a></li>

                                    <li class="dropdown-divider"></li>



                                    <li class="dropdown-item"><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                            <i class="nav-icon fa-solid fa-sign-out"></i>
                                            {{ __('تسجيل الخروج') }}
                                        </a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-black-60 me-2 btn border border-dark-subtle py-2 mx-2 px-4"
                    type="button">
                    دخول
                    <i class="fa-solid fa-arrow-right-to-bracket pe-1"></i>
                </a>
                <a href="{{ route('register') }}"
                    class="text-black-60 me-2 btn border border-dark-subtle py-2 mx-2 px-4" type="button">
                    حساب جديد
                    <i class="fa-solid fa-user-plus ps-2"></i>
                </a>
            @endif

        </nav>
    </div>
</section>
