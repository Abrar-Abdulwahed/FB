@extends('layouts.guest')
@section('title')
    {{ $page->title }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/pages/styles.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300&family=Noto+Serif:wght@300&family=Roboto+Condensed:wght@300&family=Roboto+Slab&display=swap"
        rel="stylesheet">
@endpush

@section('content')
    <!-- Start Section-1 -->
    <section id="sec-1" class="m-0 p-0">
        <div class="container">
            <nav class="navbar navbar-expand-lg px-0 mx-0">
                <a class="navbar-brand me-auto" href="#">
                    <img class="w-50" src="https://blog.mostaql.com/wp-content/uploads/2019/01/Mostaql-Logo.png"
                        alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar">
                    <ul class=" d-md-none d-lg-flex navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                موضوعات
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
                        </li>
                    </ul>
                </div>
                <button type="button" class="btn btn-primary py-3 px-4 rounded-pill">ابدا مشروعك</button>
            </nav>
        </div>
    </section>
    <!-- End Section-1 -->

    <!-- Start Section-2 -->
    <section id="sec-2">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-center bg-white">
                    <figure class="col-xs-12">
                        <div class="caption mx-3 my-3">
                            <span>{{ $page->created_at->diffForHumans() }}</span>
                            <a href="#">{{ $page->title }}</a>
                        </div>
                        <h3 class=" text-center">{{ $page->title }}</h3>
                        <img src="Images/team-01.png" alt="">
                        {!! $page->content !!}
                    </figure>
                </div>
                <div class="col-sm-12 my-4 bg-white">
                    <div class="row py-4">
                        <div class="col-sm-10">
                            <h4>Lorem ipsum</h4>
                            <p class="text-end">{{ $page->description }}</p>
                        </div>
                        <div class="col-sm-2">
                            <img class="w-75" src="Images/team-02.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section-2 -->

    <!-- Start Section-3-->
    <section id="sec-3">
        <div class="container my-4">
            <h2 class="text-end fw-bold fs-2">مقالات ذات صلة</h2>
            <div class="info">

                @foreach ($articles as $article)
                    <div class="home">
                        <a href="#"><img src="{{ asset('storage/articles/' . $article->image) }}" alt="">
                            {{ $article->title }}
                        </a>
                        <figcaption>
                            <div class="caption">
                                <span>{{ $article->created_at->diffForHumans() }}</span>
                                <a href="#">{{ $article->title }}</a>
                            </div>
                            <p> <span class="bold">{{ $article->title }}</span>
                                {{ $article->description }}
                            </p>
                        </figcaption>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Section-3 -->

    <!-- Start Section-4 -->
    <section id="sec-4" class="my-4">
        <div class="container">
            <h5 class="text-end">إترك تعليق</h5>
            <form class="bg-white py-3 px-4" action="" method="">
                <div class="comment row">
                    <div class=" f-1 row d-lg-flex">
                        <div class="col-lg-3 col-md-12">
                            <label class="in-1" for="in-1">الاسم </label> <br>
                            <input class="inp-1" type="text" name="" id="in-1">
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <label class="in-1 my-2" for="in-2">البريد الالكترونى </label> <br>
                            <input class="inp-1" type="email" name="" id="in-2">
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <label class="in-1 my-2" for="in-3">الموقع الالكترونى </label> <br>
                            <input class="inp-1" type="text" name="" id="in-3">
                        </div>
                    </div>
                    <div class="comm-area col-lg-12 col-md-12">
                        <label class="area-content" for="area">التعليق <br>
                            <textarea class="box" name="" id="area" cols="105" rows="6"></textarea>
                        </label>
                    </div>

                    <!-- <div class="comm-area col-md-12">
                                                                <label class="area-content" for="area">التعليق <br> <textarea class="box" name="" id="area" cols="105" rows="6"></textarea></label>
                                                            </div> -->

                    <div>
                        <button class="btn btn-primary" type="button">إرسال التعليق</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- End Section-4 -->

    <!-- Start Section-5 -->
    <section id="sec-5" class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 text-end">
                    <img class="img-fluid" src="https://blog.mostaql.com/wp-content/uploads/2019/01/Mostaql-Logo.png"
                        alt="">
                    <div>
                        <p>مستقل هو منصّة تصل بين أصحاب المشاريع والمستقلين في العالم العربي. إن كنت صاحب مشاريع تستطيع
                            استخدام مستقل لانجاز مشاريعك من خلال الانترنت بسهولة وأمان وتستطيع كمستقل تصفّح المشاريع
                            الموجودة وإضافة عروضك على المشاريع التي تستطيع إنجازها. يضمن مستقل حقوقك كاملة ويعمل وسيطًا بين
                            صاحب المشروع والمستقل.</p>
                    </div>
                    <div class="clearfix my-2">
                        <a class="float-end my-sm-2" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a class="float-end my-sm-2" href="#"><i class="fa-brands fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <h6 class="text-center text-sm-end">مستقل</h6>
                    <ul>
                        <li>موقع مستقل</li>
                        <li>وظف المستقلين</li>
                        <li>إبدا العمل الحر</li>
                        <li>تصفّح المشاريع</li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <h6 class="text-center text-sm-end">روابط</h6>
                    <ul>
                        <li>أضف مشروعك</li>
                        <li>مستقل للمؤسسات</li>
                        <li> معرض الاعمال</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section-5 -->
@endsection
