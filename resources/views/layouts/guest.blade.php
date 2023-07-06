<!doctype html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ config('app.name') }}| @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/blog/styles.css') }}">

    <link href="{{ asset('plugins/auth/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/auth/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/auth/css/style.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&family=Roboto+Slab&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    @stack('css')
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>

<body class="bg-body-secondary">
    <!-- navbar -->
    @include('includes.guest.navbar')

    @yield('content')

    <!-- footer -->
    @include('includes.guest.footer')



    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('plugins/auth/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/auth/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('plugins/auth/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
