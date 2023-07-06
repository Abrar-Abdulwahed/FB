<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '')</title>
    <link rel="stylesheet" href="{{ asset('css/blog/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300&family=Noto+Serif:wght@300&family=Roboto+Condensed:wght@300&family=Roboto+Slab&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

</head>

<body class="bg-body-secondary m-o p-0">
    <!-- Start navbar -->
    @include('includes.blog.navbar')
    <!-- End navbar -->

    <!-- Start content -->
    @yield('content')
    <!-- End content -->

    <!-- Start Footer -->
    @include('includes.blog.footer')
    <!-- End Footer -->
</body>
<script src="{{ asset('js/blog/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('js/blog/main.js') }}"></script>
</html>
