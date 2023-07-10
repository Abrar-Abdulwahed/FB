@extends('layouts.admin')
@section('content')
@section('title')
عرض التعليقات 
@endsection

<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">

    <div class="card-header bg-dark">
        عرض التعليقات 
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped text-center" id="users">
            <thead>
                <tr>
                    <th>id</th>
                    <th>المستخدم</th>
                    <th>المقال</th>
                    <th>التعليق </th>
                    <th>الاجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>
                            {{ $comment->user->name }}
                            <img src="{{ $comment->user->avatar_image }}" style="width:50px; height:50px" class="rounded circle">
                        </td>
                        <td><a target="_blank" href="{{ route('admin.comments.show', $comment->article_id) }}">{{ $comment->article->title }}</a></td>
                        <td>{!! $comment->comment !!}</td>
                        <td>
                            @if (!request()->has('deleted'))
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-block-{{ $comment->id }}">
                                <i class="fas fa-ban p-2"></i>حظر
                                </button>
                                <div class="modal fade" id="confirm-block-{{ $comment->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">تأكيد الحظر</p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>هل أنت متأكد من حظر هذا العنصر  ؟</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">إغلاق</button>
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="block">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">نعم</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirm-delete-{{ $comment->id }}">
                                    <i class="fas fa-trash p-2"></i>حذف
                                </button>
                                <div class="modal fade" id="confirm-delete-{{ $comment->id }}">
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
                                                <p>هل أنت متأكد من حذف هذا العنصر  ؟</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">إغلاق</button>
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">نعم</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirm-delete-all{{ $comment->id }}">
                                    <i class="fas fa-trash p-2"></i> حذف كل تعليقات المسخدم
                                </button>
                                <div class="modal fade" id="confirm-delete-all{{ $comment->id }}">
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
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="delete_all">
                                                    @method('DELETE')
                                                    
                                                    <button type="submit" class="btn btn-dark btn-md">نعم</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                            @else 
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#confirm{{ $comment->id }}">
                                <i class="fas fa-edit p-2"></i>الغاء الحذف
                                </button>
                                <div class="modal fade" id="confirm{{ $comment->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">تأكيد استعادة التعليق </p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>هل أنت متأكد من الغاء حذف هذا العنصر  ؟</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">إغلاق</button>
                                                <form action="{{ route('admin.restoreComments', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark btn-md">نعم</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-block-pre{{ $comment->id }}">
                                <i class="fas fa-ban p-2"></i>حظر
                                </button>
                                <div class="modal fade" id="confirm-block-pre{{ $comment->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">تأكيد الحظر</p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>هل أنت متأكد من حظر هذا العنصر  ؟</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">إغلاق</button>
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="block_deleted">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">نعم</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirm-delete-permanently{{ $comment->id }}">
                                    <i class="fas fa-trash p-2"></i>حذف
                                </button>
                                <div class="modal fade" id="confirm-delete-permanently{{ $comment->id }}">
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
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="deleted">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">نعم</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirm-delete-all-pre{{ $comment->id }}">
                                    <i class="fas fa-trash p-2"></i> حذف كل تعليقات المسخدم
                                </button>
                                <div class="modal fade" id="confirm-delete-all-pre{{ $comment->id }}">
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
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="delete_comment_all">
                                                    @method('DELETE')
                                                    
                                                    <button type="submit" class="btn btn-dark btn-md">نعم</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                            @endif                                    
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        </div>
    </div>

</div>

@endsection
