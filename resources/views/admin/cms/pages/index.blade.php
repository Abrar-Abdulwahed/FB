@extends('layouts.admin')
@section('content')
@section('title')
    الصفحات
@endsection
@include('partials.session')

<a href={{ route('admin.pages.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
    اضافة صفحة</a>
<div class="clearfix"></div>
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        الصفحات
    </div>
    <div class="card-body table-responsive">

        <table class="table table-striped text-center" id="pages">
            <thead>
                <tr>
                    <th>العنوان</th>
                    <th>اجراءات</th>
                </tr>
            </thead>
            <tbody>

            <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td><a target="_blank" href="{{ route('guest.pages.show', $page->slug) }}">{{ $page->title }}</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="mx-1 btn btn-success"><i
                                    class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-delete-{{ $page->id }}">
                                <i class="fas fa-trash p-2"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $page->id }}">
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
                                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST">
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
            </tbody>
        </table>

    </div>

</div>
@endsection
