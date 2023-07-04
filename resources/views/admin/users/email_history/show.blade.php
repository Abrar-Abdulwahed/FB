@extends('layouts.admin')

@section('title', 'سجل رسائل البريد الإلكتروني المرسلة للمستخدم')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            سجل رسائل البريد الإلكتروني المرسلة للمستخدم
        </div>
        <div class="card-body table-responsive">
            <div class="card card-primary card-outline">
                <div class="card-body p-0">
                    <div class="mailbox-read-info">
                        <h5>{{ $email->title }}</h5>
                        <h6>To:{{ $email->user->email }}
                            <span
                                class="mailbox-read-time float-right">{{ \Carbon\Carbon::parse($email->created_at)->format('d M. Y h:i A') }}</span>
                        </h6>
                    </div>
                    <div class="mailbox-read-message">
                        {{ $email->text }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
