@extends('layouts.admin')

@section('title', 'قائمة الرسائل المخصصة')
@section('content')
    <a href={{ route('admin.custom-message.create') }} class="btn btn-info float-right mb-2"> <i class="fa-solid fa-plus"></i>
        إضافة</a>
    <div class="clearfix"></div>
    @include('partials.session')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            قائمة الرسائل المخصصة
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@push('js')
    {{ $dataTable->scripts() }}
    <script>
        $(document).on('change', '.custom-switch input[type="checkbox"]', function() {
            let form = $(this).closest('form');
            let url = form.attr('action');
            // let data = new FormData(form[0]);
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    message: 'البيانات',
                },
                success: function(response) {
                    // handle success response if needed
                },
                error: function(xhr) {
                    // alert(xhr);
                }
            });
        });
    </script>
@endpush
