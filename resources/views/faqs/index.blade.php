@extends('layouts.admin')
@section('content')
@section('title') 
الأسئلة الشائعة
@endsection
<a href={{ route('faqs.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
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
        الأسئلة الشائعة  
    </div>
    <div class="card-body">
        <table class="table table-striped text-center" id="faqs">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>عنوان السؤال</th>
                    <th>الاجابة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                <tr>
                    <td>{{ $faq->id }}</td>
                    <td>{{ $faq->title }}</td>
                    <td>{!! $faq->answer !!} </td>
                    <td>          
                        <a href="{{ route('faqs.edit', $faq->id) }}" class="mx-1 btn btn-success"><i
                            class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="#confirm-delete-{{ $faq->id }}">
                        <i class="fas fa-trash p-2"></i>
                        </button>
                        <div class="modal fade" id="confirm-delete-{{ $faq->id }}">
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
                                        <form action="{{ route('faqs.destroy', $faq->id) }}"
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