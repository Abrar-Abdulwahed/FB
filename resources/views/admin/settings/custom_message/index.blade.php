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
    <script>
        let forms = document.querySelectorAll('.enable-message-form');

        forms.forEach(form => {
            let switchBtn = form.querySelector('.custom-switch input[type="checkbox"]');
            switchBtn.addEventListener('change', function() {
                form.submit();
            });
        });
    </script>
    {{ $dataTable->scripts()}}
@endpush
