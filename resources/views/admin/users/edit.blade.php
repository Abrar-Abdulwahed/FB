@extends('layouts.admin')
@section('title')
    تعديل بيانات العضو
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: black;
        }
    </style>
@endpush
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            تعديل بيانات العضو
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.users.update', $user->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>البريد الاكتروني</label>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>الأدوار</label>
                    <select class="select2" multiple="multiple" name="roles[]" style="width: 100%;">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">تعديل</button>
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
@endpush
