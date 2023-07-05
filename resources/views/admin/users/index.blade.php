@extends('layouts.admin')
@section('content')
@section('title')
    الأعضاء
@endsection
<a href={{ route('admin.users.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
    إضافة</a>
<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        الأعضاء
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-center" id="users">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>الاسم</th>
                        <th>البريد الالكتروني</th>
                        <th>حالة العضو</th>
                        <th>الادوار</th>
                        <th>العمليات</th>
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
                                        تأكيد
                                        <i class="fa-solid fa-envelope"></i>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $user->is_banned == 1 ? 'bg-danger' : 'bg-success' }} p-3">
                                    {{ $user->is_banned == 1 ? 'محظور' : 'نشيط' }}

                                </span>
                            </td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="badge bg-black">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.login.activity', $user->id) }}" class="mx-1 btn btn-primary"><i
                                        class="fas fa-sign-in"></i></a>
                                <a href="{{ route('admin.user.email_history', $user->id) }}" target="_blank"
                                    class="mx-1 btn btn-warning"><i class="fas fa-envelope"></i></a>
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
                                                <p class="modal-title">تأكيد الحذف</p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>هل أنت متأكد من حذف هذا العنصر حذف نهائي؟</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">إغلاق</button>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">نعم</button>
                                                </form>
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
