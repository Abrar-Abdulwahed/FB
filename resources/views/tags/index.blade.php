@extends('layouts.admin')
@section('content')
@section('title') 
Tags
@endsection
<a href={{ route('tags.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
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
        Tags  
    </div>
    <div class="card-body">
        <table class="table table-striped text-center" id="tags">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الاسم</th>
                    <th>slug</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->slug }} </td>
                    <td>          
                        <a href="{{ route('tags.edit', $tag->id) }}" class="mx-1 btn btn-success"><i
                            class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="#confirm-delete-{{ $tag->id }}">
                        <i class="fas fa-trash p-2"></i>
                        </button>
                        <div class="modal fade" id="confirm-delete-{{ $tag->id }}">
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
                                        <form action="{{ route('tags.destroy', $tag->id) }}"
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