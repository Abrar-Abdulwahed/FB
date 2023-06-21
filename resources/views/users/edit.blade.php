@extends('layouts.admin')
@section('title')
    تعديل بيانات العضو
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush
@section('content')
    <div class="container-fluid pt-3">

        <div class="p-4 bg-white">
            <h2>تعديل بيانات العضو</h2>

            @if (session()->has('success'))
                <p class="alert alert-success" role="alert">{{ session('success') }}</p>
            @endif
            @if (session()->has('errors'))
                <p class="alert alert-danger">{{ session('errors') }}</p>
            @endif

            <form action="{{ Route('users.update', $user->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row">

                    <div class="form-group col-md-12">
                        <label>الاسم</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label>البريد الاكتروني</label>
                        <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label>اختيار الادوار</label>
                        <select class="select2" multiple="multiple" data-placeholder="اختيار الادوار" name="roles[]"
                            style="width: 100%;">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ $user->roles()->where('roles.id', $role->id)->exists()? 'selected': '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">
                            اضافة</button>
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
@endpush
