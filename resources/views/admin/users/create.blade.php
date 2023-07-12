@extends('layouts.admin')
@section('title')
{{ __('admin/users/user.pages.create') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: black;
        }

        .img-preview {
            width: 200px;
            height: 200px;
            box-shadow: 0px 0px 20px 5px rgba(100, 100, 100, 0.1);
        }

        .img-preview input {
            display: none;
        }

        .img-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .img-preview div {
            position: relative;
            height: 40px;
            margin-top: -40px;
            background: rgba(0, 0, 0, 0.5);
            text-align: center;
            line-height: 40px;
            font-size: 13px;
            color: #f5f5f5;
            font-weight: 600;
        }

        .img-preview div span {
            font-size: 40px;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid pt-3">

        <div class="card shadow-sm">
            <div class="card-header bg-dark">
                اضافة عضو جديد
            </div>
            <div class="card-body">
                <form action="{{ Route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('admin/users/user.fields.name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('admin/users/user.fields.email') }}</label>
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('admin/users/user.fields.password') }}</label>
                        <input type="password" name="password" class="form-control">
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
                        <select class="select2" multiple="multiple" data-placeholder="اختيار الادوار" name="roles[]"
                            style="width: 100%;">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ collect(old('roles'))->contains($role->id) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="avatar">{{ __('admin/users/user.fields.avatar') }}</label>
                        <div class="img-preview">
                            <input type="file" id="file-1" accept="image/*" name="avatar">
                            <label for="file-1" id="file-1-preview" class="w-100 h-100">
                                <img src={{ auth()->user()->avatar_image }} alt="">
                                <div>
                                    <span>+</span>
                                </div>
                            </label>
                        </div>
                        @error('avatar')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">
                            {{ __('admin/users/user.buttons.create') }}</button>
                    </div>

            </div>
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
        })
    </script>

    <script src="{{ asset('js/previewImage.js') }}"></script>
@endpush
