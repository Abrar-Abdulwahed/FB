@extends('layouts.admin')
@section('title',__('admin/users/role.pages.edit'))
@section('content')
    <a href={{ route('admin.roles.index') }} class="btn btn-info float-right mb-2">{{ __('admin/users/role.pages.index') }}</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/users/role.pages.edit') }}
        </div>
        <div class="card-body">
            <form id="quickForm" method="POST" action={{ route('admin.roles.update', $role) }}>
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('admin/users/role.fields.name') }}</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('admin/users/role.extra.Enter the name') }}"
                        value="{{ $role->name }}">
                    @error('name')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">{{ __('admin/users/role.buttons.edit') }}</button>
            </form>
        </div>
    </div>
@endsection
