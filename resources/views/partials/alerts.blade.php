@if (session('errors') || session('error'))
    <script>
        Swal.fire({
            title: 'خطأ!',
            text: 'فشلت العملية',
            icon: 'error',
            confirmButtonText: 'المحاولة مجددا'
        })
    </script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
            title: 'تم!',
            text: 'تمت العملية بنجاح',
            icon: 'success',
            confirmButtonText: 'اكمل التصفح'
        })
    </script>
@endif
