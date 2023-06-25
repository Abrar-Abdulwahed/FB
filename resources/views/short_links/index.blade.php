@extends('layouts.admin')
@section('content')
@section('title','روابط مختصرة')
<a href={{ route('admin.short_links.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
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
        روابط مختصرة
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped text-center" id="short_links">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>url</th>
                    <th>slug</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($short_links as $short_link)
                    <tr>
                        <td>{{ $short_link->id }}</td>
                        <td><a href="{{ route('admin.short_links.show', $short_link->slug) }}">{{ $short_link->url }}</a></td>
                        <td>{{ $short_link->slug }} </td>
                        <td>
                            <a href="{{ route('admin.short_links.edit', $short_link->id) }}" class="mx-1 btn btn-success"><i
                                    class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-delete-{{ $short_link->id }}">
                                <i class="fas fa-trash p-2"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $short_link->id }}">
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
                                            <form action="{{ route('admin.short_links.destroy', $short_link->id) }}" method="POST">
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
