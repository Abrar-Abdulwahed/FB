@extends('layouts.admin')

@section('title', __('admin/users/user.pages.The record of emails sent to the user') )
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/users/user.pages.The record of emails sent to the user') }}
        </div>
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-striped text-center" id="users">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>{{ __('admin/users/user.fields.title') }}</th>
                            <th>{{ __('admin/users/user.fields.created_at') }}</th>
                            <th>{{ __('admin/users/user.extra.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($emails as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <b>{{ $item->title }}</b>
                                </td>
                                <td>
                                    {{ $item->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.user.email_show', ['user_id' => $user_id, 'email_id' => $item->id]) }}"
                                        class="mx-1 btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-danger text-center">{{ __('admin/users/user.extra.There are no messages yet') }}   
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
