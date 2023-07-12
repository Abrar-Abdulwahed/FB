@extends('layouts.admin')
@section('title')
    {{ __('admin/users/user.pages.edit') }}  
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/previewImage.css') }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: black;
        }
    </style>
@endpush
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/users/user.pages.edit') }}
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>{{ __('admin/users/user.fields.name') }}</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('admin/users/user.fields.email') }}</label>
                    <input type="text" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('admin/users/user.fields.password') }}</label>
                    <input type="password" name="password" class="form-control"
                        placeholder="{{ __('admin/users/user.extra.Leave it blank if not changed') }}">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('admin/users/user.fields.password_confirmation') }}</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('admin/users/user.fields.roles') }}</label>
                    <select class="select2" multiple="multiple" name="roles[]" style="width: 100%;">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $user->roles->contains('id', $role->id) || collect(old('roles'))->contains($role->id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label>{{ __('admin/users/user.fields.is_banned') }}</label>
                        <select class="form-control" name="is_banned">
                            <option value="0" {{ $user->is_banned == 0 ? 'selected' : '' }}>{{ __('admin/users/user.extra.active') }}
                            </option>
                            <option value="1" {{ $user->is_banned == 1 ? 'selected' : '' }}>{{ __('admin/users/user.extra.banned') }}
                            </option>
                        </select>
                        @error('is_banned')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label>{{ __('admin/users/user.fields.banned_until') }}</label>
                        <input type="datetime-local" name="banned_until" class="form-control"
                            value="{{ old('banned_until', $user->banned_until) }}">
                        @error('banned_until')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="">
                    <label for="avatar">{{ __('admin/users/user.fields.avatar') }}</label>
                    <div class="img-preview">
                        <input type="file" id="file-1" accept="image/*" name="avatar">
                        <label for="file-1" id="file-1-preview" class="w-100 h-100">
                            <img src={{ $user->avatar_image }} alt="">
                            <div>
                                <span>+</span>
                            </div>
                        </label>
                    </div>
                    @error('avatar')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success mt-3">{{ __('admin/users/user.buttons.edit') }}</button>
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
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
    <script src="{{ asset('js/previewImage.js') }}"></script>
@endpush
