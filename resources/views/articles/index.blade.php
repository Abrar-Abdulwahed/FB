@extends('layouts.admin')
@section('content')
@section('title')
    الأعضاء
@endsection
<a href={{ route('admin.articles.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
    اضافة مقال</a>
<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        الأعضاء
    </div>
    <div class="card-body">

        <table class="table table-striped text-center" id="articles">
            <thead>
                <tr>
                    <th>العنوان</th>
                    <th>الصورة</th>
                    <th>اجراءات</th>
                </tr>
            </thead>
            <tbody>

            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td><a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a></td>
                        <td>

                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                width="70px" height="70px">
                        </td>
                        <td>
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="mx-1 btn btn-success"><i
                                    class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-delete-{{ $article->id }}">
                                <i class="fas fa-trash p-2"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $article->id }}">
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
                                            <form action="{{ route('admin.articles.destroy', $article->id) }}"
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
            </tbody>
        </table>

    </div>

</div>
@endsection