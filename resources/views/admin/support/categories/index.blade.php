@extends('layouts.admin')

@section('title', 'قائمه تصنيفات التذاكر')
@section('content')
    <a href={{ route('admin.TicketsCategory.create') }} class="btn btn-info float-right mb-2"> <i class="fa-solid fa-plus"></i>
        إضافة</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            قائمة تصنيفات التذاكر
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>النوع</th>
                        <th style="width:100px">العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.TicketsCategory.edit', $item->id) }}"
                                        class="mx-1 btn btn-success"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="mx-1 btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#confirm-delete-{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="confirm-delete-{{ $item->id }}">
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
                                                    <form action="{{ route('admin.TicketsCategory.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark btn-md">نعم</button>
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
                            <td colspan="6" class="text-danger text-center">لا توجدانواع بعد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {!! $categories->links() !!}
        </div>
    </div>
@endsection
