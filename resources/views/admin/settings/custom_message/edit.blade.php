@extends('layouts.admin')
@section('title', 'تحرير رسائل مخصصة')
@section('content')
    <a href={{ route('admin.custom-message.index') }} class="btn btn-info float-right mb-2">جميع الرسائل المخصصة</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            تحرير رسالة مخصصة
        </div>
        <div class="card-body">
            <form id="quickForm" method="POST" action={{ route('admin.custom-message.update', $message) }}>
                @method('PUT')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="code">الرمز</label>
                        <input type="text" name="code" class="form-control" id="code" placeholder="ادخل الرمز"
                            value="{{ $message->code }}">
                        @error('code')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="subject">العنوان</label>
                        <input type="text" name="subject" class="form-control" id="subject" placeholder="ادخل العنوان"
                            value="{{ $message->subject }}">
                        @error('subject')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="type">النوع</label>
                        <select class="form-control" name="type" id="type">
                            <option value="">اختر نوع الرسالة</option>
                            <option value="sms" {{ $message->type == 'sms' ? 'selected' : '' }}>sms</option>
                            <option value="email" {{ $message->type == 'email' ? 'selected' : '' }}>إيميل</option>
                        </select>
                        @error('type')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="language">اللغة</label>
                        <select class="form-control" name="language" id="language">
                            <option value="">اختر اللغة</option>
                            <option value="ar" {{ $message->language == 'ar' ? 'selected' : '' }}>العربية</option>
                            <option value="en" {{ $message->language == 'en' ? 'selected' : '' }}>الانجليزية</option>
                        </select>
                        @error('language')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="text">النص</label>
                    <textarea class="form-control ckeditor" id="text" rows="3" name="text" placeholder="اكتب النص هنا">{{ $message->text }}</textarea>
                    @error('text')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-12 custom-control custom-switch my-4">
                    <input type="text" class="custom-control-input" name="is_active" value="off">
                    <input type="checkbox" class="custom-control-input" id="is-active" name="is_active"
                        @checked($message->is_active == 1)>
                    <label class="custom-control-label" for="is-active">الحالة</label>
                </div>
                <button type="submit" class="btn btn-success">تعديل</button>
            </form>
        </div>
    </div>
@endsection
