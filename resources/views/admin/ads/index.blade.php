@extends('layouts.admin')
@section('content')
@section('title')
    الاعلانات
@endsection
<a href={{ route('admin.ads.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
    إضافة</a>
<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        الأعلانات
    </div>
    <div class="card-body">
        <table class="table table-striped text-center" id="ads">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الاسم</th>
                    <th>الرساله</th>
                    <th>نوع الارسال</th>
                    <th>تاريخ البدايه/النهايه</th>
                    <th>تاريخ اخر تحديث</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ads as $index=>$ad)
                    <tr>
                        <td>{{ $index +1 }}</td>
                        <td>{{ $ad->name }}</td>
                        <td>{{ Str::limit($ad->message,20) }} </td>
                        <td>{{ __($ad->type) }} </td>
                        <td>{{ $ad->start_date !='' ? $ad->start_date().' - '.$ad->end_date():'-'}}</td>
                        <td>{{ $ad->updated_at() }}</td>
                        <td>
                            <a href="{{ route('admin.ads.edit', $ad->id) }}" class="mx-1 btn btn-success"><i
                                    class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-delete-{{ $ad->id }}">
                                <i class="fas fa-trash p-2"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $ad->id }}">
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
                                            <form action="{{ route('admin.ads.destroy', $ad->id) }}"
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
        {{ $ads->links() }}
    </div>

</div>

@endsection
