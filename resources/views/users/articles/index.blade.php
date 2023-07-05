@extends('layouts.blog')

@section('title', 'المقالات')

@section('content')
    <!-- Start Section-2 -->
    <section id="sec-2">
		<div class="container">
            <div class="row">
                @foreach ($articles as $article)
                    <figure class="col-lg-6 col-md-12">
                        @if (!empty($article->image))
                            <img src="{{ asset('storage/articles/'.$article->image) }}" alt="">
                        @else
                            
                        @endif
                        
                        <figcaption>
                            <div class="caption">
                                <a href="{{ route('articles.show',$article->slug) }}">{{ $article->title }}</a>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>
                            <div> <span class="bold text-end"> {{ $article->description }} </span>
                                {!! $article->content !!}
                            </div>
                            
                        </figcaption>
                    </figure>
                @endforeach
            </div>
		</div>
	</section>
<!-- End Section-2 -->

<!-- Start Section-3 -->
    <section id="sec-3">
		<div class="container">
            <div class="row">
                <figure class="col-lg-4 col-md-12">
                    <img src="Images/course-05.jpg" alt="">
                    <figcaption>
                        <div  class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </figure>
                <figure class="col-lg-4 col-md-12">
                    <img src="Images/course-05.jpg" alt="">
                    <figcaption>
                        <div  class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </figure>
                <figure class="col-lg-4 col-md-12">
                    <img src="Images/course-05.jpg" alt="">
                    <figcaption>
                        <div class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </figure>
            </div>
		</div>
	</section>
<!-- End Section-3 -->

<!-- Start Section-4 -->
    <section id="sec-4">
		<div class="container">
            <div class="row">
                <figure class="col-lg-4 col-md-12">
                    <img src="Images/course-05.jpg" alt="">
                    <figcaption>
                        <div  class="caption">
                            <span> منذ 23 ساعة</span>
                            <a href="#">هندسة وتصميم داخلى</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </figure>
                <figure class="col-lg-4 col-md-12">
                    <img src="Images/course-05.jpg" alt="">
                    <figcaption>
                        <div  class="caption">
                            <span> منذ 23 ساعة</span>
                            <a href="#">هندسة وتصميم داخلى</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </figure>
                <figure class="col-lg-4 col-md-12">
                    <img src="Images/course-05.jpg" alt="">
                    <figcaption>
                        <div class="caption">
                            <span> منذ 23 ساعة</span>
                            <a href="#">هندسة وتصميم داخلى</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </figure>
            </div>
		</div>
	</section>
<!-- End Section-4 -->

<!-- Start Page -->
    <nav class="d-flex justify-content-center my-4">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link">التالى</a>
            </li>
            <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-ellipsis"></i></a></li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">1</a>
            </li>
        </ul>
    </nav>
<!-- End Page -->

<!-- Start Section-3 -->
    <section id="sec-3">
		<div class="container my-4">
            <h2 class="text-center my-4 fw-bold fs-2">العمل الحر</h2>
            <div class="row">
                <figure class="col-lg-4 col-md-12">
                    <img src="Images/course-05.jpg" alt="">
                    <figcaption>
                        <div  class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </figure>
                <figure class="col-lg-4 col-md-12">
                    <img src="Images/course-05.jpg" alt="">
                    <figcaption>
                        <div  class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </figure>
                <figure class="col-lg-4 col-md-12">
                    <img src="Images/course-05.jpg" alt="">
                    <figcaption>
                        <div class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </figure>
            </div>
		</div>
	</section>
<!-- End Section-3 -->

<!-- Start Section-3 -->
<section id="sec-3">
    <div class="container my-4">
        <h2 class="text-center my-4 fw-bold fs-2">ريادة أعمال</h2>
        <div class="row">
            <figure class="col-lg-4 col-md-12">
                <img src="Images/course-05.jpg" alt="">
                <figcaption>
                    <div  class="caption">
                        <span>منذ 3 أيام</span>
                        <a href="#">ترجمة</a>
                    </div>
                    <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                        يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                    </p>
                </figcaption>
            </figure>
            <figure class="col-lg-4 col-md-12">
                <img src="Images/course-05.jpg" alt="">
                <figcaption>
                    <div  class="caption">
                        <span>منذ 3 أيام</span>
                        <a href="#">ترجمة</a>
                    </div>
                    <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                        يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                    </p>
                </figcaption>
            </figure>
            <figure class="col-lg-4 col-md-12">
                <img src="Images/course-05.jpg" alt="">
                <figcaption>
                    <div class="caption">
                        <span>منذ 3 أيام</span>
                        <a href="#">ترجمة</a>
                    </div>
                    <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                        يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                    </p>
                </figcaption>
            </figure>
        </div>
    </div>
</section>
<!-- End Section-3 -->

<!-- Start Section-5-->
<section id="sec-5">
    <div class="container my-4">
        <h2 class="text-center fw-bold fs-2">قصص نجاح</h2>
        <div class="row">
            
            <figure class="col-lg-4 col-md-12">
                <div class="home">
                    <a href="#"><img src="Images/team-01.png" alt=""></a>
                    <figcaption>
                        <div  class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </div>
            </figure>
            <figure class="col-lg-4 col-md-12">
                <div class="home">
                    <a href="#"><img src="Images/team-02.png" alt=""></a>
                    <figcaption>
                        <div  class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </div>
            </figure>
            <figure class="col-lg-4 col-md-12">
                <div class="home">
                    <a href="#"><img src="Images/team-03.png" alt=""></a>
                    <figcaption>
                        <div  class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </div>
            </figure>
        </div>
    </div>
</section>
<!-- End Section-5 -->
@endsection