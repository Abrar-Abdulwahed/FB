@extends('layouts.admin')
@section('content')
@section('title')
{{ __('admin/users/login_activity.pages.index') }}
@endsection

<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        {{ __('admin/users/login_activity.pages.index') }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped text-center" id="users">
            <thead>
                <tr>
                    <th>{{ __('admin/users/login_activity.fields.user_id') }}</th>
                    <th>{{ __('admin/users/login_activity.fields.user_agent') }}</th>
                    <th>{{ __('admin/users/login_activity.fields.ip') }}</th>
                    <th>{{ __('admin/users/login_activity.fields.browser') }}</th>
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
