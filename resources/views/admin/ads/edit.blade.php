@extends('layouts.admin')
@section('title')
    تعديل الاعلان
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
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            تعديل الاعلان
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.ads.update', $ad->id) }}" method="post" >
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="name" value="{{ old('name',$ad->name) }}" class="form-control">
                    @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label>نوع الارسال</label>
                    <select class="select2" name="type" style="width: 100%;">
                        <option value="" selected disabled readonly >--اختر نوع الارسال --</option>
                        <option value="email" {{ old('type',$ad->type) == 'email' ? 'selected' : null }}>البريد الالكترونى</option>
                        <option value="sms" {{ old('type',$ad->type) == 'sms' ? 'selected' : null }}>رساله الهاتف</option>
                        <option value="notification" {{ old('type',$ad->type) == 'notification' ? 'selected' : null }}>اشعار</option>
                        <option value="all" {{ old('type',$ad->type) == 'all' ? 'selected' : null }}>الكل</option>
                    </select>
                    @error('type')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label>الرساله</label>
                    <textarea name="message" id="" cols="30" rows="10" class="form-control">{{ $ad->message }}</textarea>
                    @error('message')<p class="text-danger">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn btn-success">تعديل</button>
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

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endpush
