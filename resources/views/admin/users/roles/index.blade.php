@extends('layouts.admin')

@section('title', __('admin/users/role.pages.index'))
@section('content')
    <a href={{ route('admin.roles.create') }} class="btn btn-info float-right mb-2"> <i class="fa-solid fa-plus"></i>
        {{ __('admin/users/role.buttons.create') }}</a>
    <div class="clearfix"></div>
    @include('partials.session')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/users/role.pages.index') }}
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>{{ __('admin/users/role.fields.name') }}</th>
                        <th>{{ __('admin/users/role.extra.users') }}</th>
                        <th style="width:100px">{{ __('admin/users/role.extra.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->users->count() }}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="mx-1 btn btn-success"><i
                                            class="fas fa-edit"></i></a>
                                    <button type="button" class="mx-1 btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#confirm-delete-{{ $role->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="confirm-delete-{{ $role->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <p class="modal-title">{{ __('admin/users/role.extra.confirm_delete') }}</p>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <p>{{ __('admin/users/role.extra.Are you sure you want delete this item') }}</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default btn-md"
                                                        data-dismiss="modal">{{ __('admin/users/role.extra.close') }}</button>
                                                    <form action="{{ route('admin.roles.destroy', $role->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark btn-md">{{ __('admin/users/role.extra.yes') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center">لا توجد أدوار بعد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {!! $roles->links() !!}
        </div>
    </div>
@endsection
