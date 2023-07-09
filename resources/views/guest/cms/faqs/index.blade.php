@extends('layouts.guest')
@section('title')
    الاسئلةالشائعة
@endsection
@section('content')
    <!-- Start Section-1 -->
    <div class="container">
        <h6 class="text-end mb-2 text-black-50">الرئيسية</h6>
        <h4 class="text-end mb-5">الاسئلة الشائعة</h4>
    </div>


    <div class="container bg-white">
        <div class="content ">
            @foreach ($faqs as $index => $faq)
                <div class="list">
                    <div class="d-flex justify-content-between">
                        <h6 class="pt-1 pe-3">{{ $faq->title }}</h6>
                        <p>
                            <a class="btn" data-bs-toggle="collapse" href="#faq-{{ $index }}" role="button"
                                aria-expanded="false" aria-controls="faq-{{ $index }}">
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </a>
                        </p>
                    </div>

                    <div class="collapse pb-3" id="faq-{{ $index }}">
                        <ul>
                            <li><p class="text-end">{!! $faq->answer !!}</p></li>
                        </ul>
                    </div>
                </div>
                <hr class="text-center" style="width: 90%; text-align:center; margin: 0 auto">
                <p class="line"></p>
            @endforeach
        </div>
    </div>

    <!-- End Section-1 -->
@endsection
