@extends('layouts.admin')
@section('title', 'تحرير رسائل مخصصة')
@section('content')
    <a href={{ route('custom-message.index') }} class="btn btn-info float-right mb-2">جميع الرسائل المخصصة</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            معاينة الرسالة المخصصة
        </div>
        <div class="card-body">
            <div class="col-12">
                <h4><i class="fas fa-globe"></i> {{ $message->code }}</h4>
                <h6><small class="float-right">آخر تعديل: {{ $message->updated_at }}</small></h6>
            </div>
            <div class="p-3 mb-3">
                <div class="row">
                    <div class="col-sm-4">
                        <strong>النوع</strong>
                        <p>{{ $message->type }}</p>
                    </div>
                    <div class="col-sm-4">
                        <strong>اللغة</strong>
                        <p>{{ $message->language }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            {{ $message->text }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
