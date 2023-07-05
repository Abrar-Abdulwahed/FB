<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المقالات</title>
    <link rel="stylesheet" href="{{ asset('css/blog/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <style>
        figcaption p{
            text-align:right;
        }

    </style>
</head>

<body class="bg-body-secondary m-o p-0">
    <!-- Start navbar -->
    @include('layouts_blog.navbar')      
    <!-- End navbar -->

    <!-- Start content -->
    @yield('content')      
    <!-- End content -->

    <!-- Start Footer -->
    @include('layouts_blog.footer')
    <!-- End Footer -->

    <script src="{{ asset('js/blog/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/blog/main.js') }}"></script>
</body>
</html>