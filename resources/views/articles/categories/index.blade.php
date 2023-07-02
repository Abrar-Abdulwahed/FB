@extends('layouts.admin')
@section('content')
@section('title')
    Articles Categories
@endsection
<a href={{ route('admin.articles-categories.create') }} class="btn btn-info float-left my-2"> <i
        class="fa-solid fa-plus"></i>
    إضافة</a>
<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        Articles Categories
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الاسم</th>
                    <th>slug</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                    <tr>
                        <td>{{ $category->index + 1 }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }} </td>
                        <td>
                            <a href="{{ route('admin.articles-categories.edit', $category->id) }}"
                                class="mx-1 btn btn-success"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-delete-{{ $category->id }}">
                                <i class="fas fa-trash p-2"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $category->id }}">
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
                                            <form
                                                action="{{ route('admin.articles-categories.destroy', $category->id) }}"
                                                method="POST">
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