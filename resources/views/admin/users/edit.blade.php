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
            <form action="{{ Route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>البريد الاكتروني</label>
                    <input type="text" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" name="password" class="form-control"
                        placeholder="اتركها فارغة في حالة عدم التغيير">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>الأدوار</label>
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
                        <label>حالة العضو</label>
                        <select class="form-control" name="is_banned">
                            <option value="0" {{ $user->is_banned == 0 ? 'selected' : '' }}>نشيط
                            </option>
                            <option value="1" {{ $user->is_banned == 1 ? 'selected' : '' }}>محظور
                            </option>
                        </select>
                        @error('is_banned')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label>تاريخ فك الحظر</label>
                        <input type="datetime-local" name="banned_until" class="form-control"
                            value="{{ old('banned_until', $user->banned_until) }}">
                        @error('banned_until')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>صورة العضو</label>
                    <input type="file" name="avatar" class="form-control">
                    @error('avatar')
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
