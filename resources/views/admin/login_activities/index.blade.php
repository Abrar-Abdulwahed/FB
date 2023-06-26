@extends('layouts.admin')
@section('content')
@section('title')
نشاط تسجيل الدخول
@endsection

<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        نشاط تسجيل الدخول
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped text-center" id="users">
            <thead>
                <tr>
                    <th>المستخدم</th>
                    <th>User Agent</th>
                    <th>IP </th>
                    <th>المتصفح</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($login_activities as $login_activity)
                    <tr>
                        <td>{{ $login_activity->user_id }}</td>
                        <td>{{ $login_activity->user_agent }}</td>
                        <td>{{ $login_activity->ip }}</td>
                        <td>{{ $login_activity->browser }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        </div>
    </div>

</div>

@endsection
