@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('admin/users/user.pages.index') }}
@endsection
<a href={{ route('admin.users.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
    {{ __('admin/users/user.buttons.create') }}</a>
<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        {{ __('admin/users/user.pages.index') }}
    </div>
    <div class="card-body">
        <form id="filter-form" class="form-row align-items-center mb-3" action="{{ route('admin.users.index') }}"
            method="GET">
            <label for="role">{{ __('admin/users/user.extra.filters') }}</label>
            <div class="col-md-4">
                <select name="role" class="form-control" id="role">
                    <option value="all" @selected(request('role') === 'all' || null)>{{ __('admin/users/user.fields.roles') }}</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" @selected(request('role') == $role->name)>
                            {{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-filter"></i></button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped text-center" id="users">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>{{ __('admin/users/user.fields.name') }}</th>
                        <th>{{ __('admin/users/user.fields.email') }}</th>
                        <th>{{ __('admin/users/user.fields.is_banned') }}</th>
                        <th>{{ __('admin/users/user.fields.roles') }}</th>
                        <th>{{ __('admin/users/user.fields.last_activity') }}</th>
                        <th>{{ __('admin/users/user.extra.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div>
                                    @if ($user->avatar)
                                        <img class="mx-2 rounded-circle" src="{{ $user->avatar_image }}" width="50px"
                                            height="50px">
                                    @endif
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td>
                                {{ $user->email }}
                                @if (!$user->email_verified_at)
                                    <a href="{{ route('admin.users.verifyEmail', $user->id) }}"
                                        class="bg-warning p-1 rounded" style="font-size: 12px">
                                        {{ __('admin/users/user.extra.confirm') }}
                                        <i class="fa-solid fa-envelope"></i>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $user->is_banned == 1 ? 'bg-danger' : 'bg-success' }} p-3">
                                    {{ $user->is_banned == 1 ?  __('admin/users/user.extra.banned') :  __('admin/users/user.extra.active') }}

                                </span>
                            </td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="badge bg-black">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ Carbon\Carbon::parse($user->last_activity) }}
                                <br>
                                {{ $user->last_activity != null ? Carbon\Carbon::parse($user->last_activity)->diffForHumans(Carbon\Carbon::now()) : 'لم يظهر' }}
                            </td>
                            <td>
                                @if (!request()->has('trashed'))
                                    <a href="{{ route('admin.login.activity', $user->id) }}"
                                        class="mx-1 btn btn-primary"><i class="fas fa-sign-in"></i></a>
                                    <a href="{{ route('admin.user.email_history', $user->id) }}" target="_blank"
                                        class="mx-1 btn btn-warning"><i class="fas fa-envelope"></i></a>
                                    <a href="{{ route('admin.users.activities', $user->id) }}"
                                        class="mx-1 btn btn-secondary"><i class="fas fa-eye"></i></a>
                                @endif
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="mx-1 btn btn-success"><i
                                        class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirm-delete-{{ $user->id }}">
                                    <i class="fas fa-trash p-2"></i>
                                </button>
                                <div class="modal fade" id="confirm-delete-{{ $user->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">{{ __('admin/users/user.extra.confirm_delete') }} </p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>{{ __('admin/users/user.extra.Are you sure you want delete this item') }}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">{{ __('admin/users/user.extra.close') }}</button>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/users/user.extra.yes') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
