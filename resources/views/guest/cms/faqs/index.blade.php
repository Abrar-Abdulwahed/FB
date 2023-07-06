@extends('layouts.guest')

@section('content')
    <!-- Start Section-1 -->
    <div class="container">
        <h6 class="text-end mb-2 text-black-50">الرئيسية</h6>
        <h4 class="text-end mb-5">الاسئلة الشائعة</h4>
    </div>

    <div class="container bg-white">
        <div class="header row">
            <div class="col-4 active pb-3 pt-3">
                <h5 id="active" class="text-center px-2 ">المشتري</h5>
            </div>
            <div class="col-4 pb-3 pt-3">
                <h5 class="text-center px-2">البائع</h5>
            </div>
            <div class="col-4 pb-3 pt-3">
                <h5 class="text-center px-2">عام</h5>
            </div>
        </div>
    </div>

    <div class="container bg-white">
        <div class="content ">
            @foreach ($faqs as $faq)
                <div class="list">
                    <div class="d-flex justify-content-between">
                        <h6 class="pt-1 pe-3">{{ $faq->title }}</h6>
                        <p>
                            <a class="btn" data-bs-toggle="collapse" href="#list" role="button" aria-expanded="false"
                                aria-controls="collapseExample">
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </a>
                        </p>
                    </div>

                    <div class="collapse pb-3" id="list">
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

@push('scripts')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@endpush
