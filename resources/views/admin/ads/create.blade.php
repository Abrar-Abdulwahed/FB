@extends('layouts.admin')
@section('title')
    اضافة ااعلان
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: black;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid pt-3">

        <div class="card shadow-sm">
            <div class="card-header bg-dark">
                اضافة اعلان جديد
            </div>
            <div class="card-body">
                <form action="{{ Route('admin.ads.store') }}" method="post" >
                    @csrf

                    <div class="form-group">
                        <label>الاسم</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label>نوع الارسال</label>
                        <select class="select2" name="type" style="width: 100%;">
                            <option value="" selected disabled readonly >--اختر نوع الارسال --</option>
                            <option value="email" {{ old('type') == 'email' ? 'selected' : null }}>البريد الالكترونى</option>
                            <option value="sms" {{ old('type') == 'sms' ? 'selected' : null }}>رساله الهاتف</option>
                            <option value="notification" {{ old('type') == 'notification' ? 'selected' : null }}>اشعار</option>
                            <option value="all" {{ old('type') == 'all' ? 'selected' : null }}>الكل</option>
                        </select>
                        @error('type')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label>الرساله</label>
                        <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                        @error('message')<p class="text-danger">{{ $message }}</p>@enderror
                    </div>


                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">
                            اضافة</button>
                    </div>

            </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endpush
