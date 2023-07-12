<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '') - لوحة التحكم</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    @stack('css')

    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }

        .dropdown-item a {
            text-decoration: none;
            color: black;
        }
    </style>

    <!-- data tables -->
    <!-- data tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.2.1/css/fixedColumns.dataTables.min.css">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('includes.admin.navbar')
        @include('includes.admin.sidebar')
        <div class="content-wrapper mt-2">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('includes.admin.footer')
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
    @stack('js')

    <!-- datatable -->

    <!-- datatable -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.1/js/dataTables.fixedColumns.min.js"></script>

</body>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script src="//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json"></script>
<script>
    var table = new DataTable('#users', {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json',
        },
    });

    var table = new DataTable('#users-activities', {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json',
        },
    });

    var table = new DataTable('#short_links', {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json',
        },
    });
</script>



<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('.ckeditor'), {
            language: {
                content: 'ar'
            },
            toolbar: {
                items: [
                    'undo', 'redo',
                    '|', 'heading', 'alignment',
                    '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                    '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                    '|', 'link', 'uploadImage', 'blockQuote', 'codeBlock',
                    '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                ],
                shouldNotGroupWhenFull: true
            }
        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>

</html>
