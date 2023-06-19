<!doctype html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ config('app.name') }}| @yield('title')</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {!! ReCaptcha::htmlScriptTagJsApi() !!}

</head>

<body>
    <!-- navbar -->
    @include('layouts.navbar')

    @yield('content')

    <!-- footer -->
    @include('layouts.footer')


    <script>
        import Swal from 'sweetalert2/dist/sweetalert2.js';
    </script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>


</body>

</html>
