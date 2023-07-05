@extends('layouts.admin')
@section('content')
@section('title')
    ملفات
@endsection
<a href={{ route('admin.uploads.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
    إضافة</a>
<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        ملفات
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped text-center" id="uploads">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الاسم</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                    <tr>
                        <td>{{ $file->id }}</td>
                        <td>
                            <a href="{{ asset('storage/uploads/' . $file->name) }}">{{ $file->name }}</a>
                            {{-- <img class="rounded" width="70" height="70" src="{{ asset('storage/uploads/' . $file->name) }}" alt=""> --}}
                        </td>
                        <td>
                            <a href="{{ route('admin.uploads.download', $file->id) }}" class="mx-1 btn btn-info"><i
                                    class="fa-solid fa-download"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-delete-{{ $file->id }}">
                                <i class="fas fa-trash p-2"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $file->id }}">
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
                                            <form action="{{ route('admin.uploads.destroy', $file->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark btn-md">نعم</button>
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
@endsection
