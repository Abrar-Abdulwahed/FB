@extends('layouts.guest')
@section('title')
    الاسئلة الشائعة
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
                            <li>{{ $faq->answer }}</li>
                        </ul>
                        <div>

                        </div>
                    </div>
                </div>

                <p class="line"></p>
            @endforeach
        </div>
    </div>

    <!-- End Section-1 -->
@endsection
