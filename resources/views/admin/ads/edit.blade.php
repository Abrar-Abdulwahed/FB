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
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>الاسم</label>
                            <input type="text" name="name" value="{{ old('name',$ad->name) }}" class="form-control">
                            @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>النوع</label>
                            <select class="form-control " name="gender" >
                                <option value="" selected disabled readonly >--اختر النوع--</option>
                                <option value="male" {{ old('gender',$ad->gender) == 'male' ? 'selected' : null }}>ذكر</option>
                                <option value="female" {{ old('gender',$ad->gender) == 'female' ? 'selected' : null }}>انثى</option>
                            </select>
                            @error('gender')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>نوع الارسال</label>
                            <select class="form-control " name="type" style="width: 100%;">
                                <option value="" selected disabled readonly >--اختر نوع الارسال --</option>
                                <option value="email" {{ old('type',$ad->type) == 'email' ? 'selected' : null }}>البريد الالكترونى</option>
                                <option value="sms" {{ old('type',$ad->type) == 'sms' ? 'selected' : null }}>رساله الهاتف</option>
                                <option value="notification" {{ old('type',$ad->type) == 'notification' ? 'selected' : null }}>اشعار</option>
                                <option value="all" {{ old('type',$ad->type) == 'all' ? 'selected' : null }}>الكل</option>
                            </select>
                            @error('type')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>الدوله</label>
                            <select class="form-control select2" name="country" >
                                <option value="" selected disabled readonly >--اختر الدوله--</option>
                                @include('Admin.ads.country2')
                            </select>
                            @error('country')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="start_date">تاريخ البدء</label>
                            <input type="date" class="form-control" placeholder="start_date"
                                   name="start_date" id="start_date" value="{{ old('start_date',$ad->start_date) }}" >
                            @error('start_date')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="end_date">تاريخ الانتهاء</label>
                            <input type="date" class="form-control" placeholder="end_date"
                                   name="end_date" id="end_date" value="{{ old('end_date',$ad->end_date) }}" >
                            @error('end_date')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="min_age">اقل عمر</label>
                            <input type="number" class="form-control" placeholder="min_age"
                                   name="min_age" id="min_age" value="{{ old('min_age',$ad->min_age) }}" >
                            @error('min_age')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="max_age">اكبر عمر</label>
                            <input type="number" class="form-control" placeholder="max_age"
                                   name="max_age" id="max_age" value="{{ old('max_age',$ad->max_age) }}" >
                            @error('max_age')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>الرساله</label>
                            <textarea name="message" id="" cols="30" rows="10" class="form-control">{{ $ad->message }}</textarea>
                            @error('message')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>
                    </div>
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
            // $('.select2bs4').select2({
            //     theme: 'bootstrap4'
            // })
        })
    </script>
@endpush
