@extends('layouts.admin')
@section('content')
@section('title')
{{ __('admin/CMS/Blog/Comment/article_comment.pages.index') }}
@endsection

<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">

    <div class="card-header bg-dark">
        {{ __('admin/CMS/Blog/Comment/article_comment.pages.index') }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped text-center" id="users">
            <thead>
                <tr>
                    <th>{{ __('admin/CMS/Blog/Comment/article_comment.fields.id') }}</th>
                    <th>{{ __('admin/CMS/Blog/Comment/article_comment.fields.user_id') }}</th>
                    <th>{{ __('admin/CMS/Blog/Comment/article_comment.fields.article_id') }}</th>
                    <th>{{ __('admin/CMS/Blog/Comment/article_comment.fields.comment') }} </th>
                    <th>{{ __('admin/CMS/Blog/Comment/article_comment.extra.actions') }}</th>
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
                                <i class="fas fa-ban p-2"></i>{{ __('admin/CMS/Blog/Comment/article_comment.extra.block') }}
                                </button>
                                <div class="modal fade" id="confirm-block-{{ $comment->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">{{ __('admin/CMS/Blog/Comment/article_comment.extra.confirm_block') }}</p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>{{ __('admin/CMS/Blog/Comment/article_comment.extra.Are you sure you want block this item') }}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">{{ __('admin/CMS/Blog/Comment/article_comment.extra.close') }}</button>
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="block">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/CMS/Blog/Comment/article_comment.extra.yes') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirm-delete-{{ $comment->id }}">
                                    <i class="fas fa-trash p-2"></i>{{ __('admin/CMS/Blog/Comment/article_comment.buttons.delete') }}
                                </button>
                                <div class="modal fade" id="confirm-delete-{{ $comment->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">{{ __('admin/CMS/Blog/Comment/article_comment.extra.confirm_delete') }}</p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>{{ __('admin/CMS/Blog/Comment/article_comment.extra.Are you sure you want delete this item') }}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">{{ __('admin/CMS/Blog/Comment/article_comment.extra.close') }}</button>
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/CMS/Blog/Comment/article_comment.extra.yes') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirm-delete-all{{ $comment->id }}">
                                    <i class="fas fa-trash p-2"></i> {{ __('admin/CMS/Blog/Comment/article_comment.extra.Delete all comments of this user') }}   
                                </button>
                                <div class="modal fade" id="confirm-delete-all{{ $comment->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">{{ __('admin/CMS/Blog/Comment/article_comment.extra.confirm_delete') }}</p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>{{ __('admin/CMS/Blog/Comment/article_comment.extra.Are you sure you want delete all comments of this user') }}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">{{ __('admin/CMS/Blog/Comment/article_comment.extra.close') }}</button>
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="delete_all">
                                                    @method('DELETE')
                                                    
                                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/CMS/Blog/Comment/article_comment.extra.yes') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                            @else 
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#confirm{{ $comment->id }}">
                                <i class="fas fa-edit p-2"></i>{{ __('admin/CMS/Blog/Comment/article_comment.extra.cancel_delete') }}
                                </button>
                                <div class="modal fade" id="confirm{{ $comment->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">{{ __('admin/CMS/Blog/Comment/article_comment.extra.confirm_restore_comment') }}</p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>{{ __('admin/CMS/Blog/Comment/article_comment.extra.Are you sure you want to restore this item') }}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">{{ __('admin/CMS/Blog/Comment/article_comment.extra.close') }}</button>
                                                <form action="{{ route('admin.restoreComments', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/CMS/Blog/Comment/article_comment.extra.yes') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-block-pre{{ $comment->id }}">
                                <i class="fas fa-ban p-2"></i>{{ __('admin/CMS/Blog/Comment/article_comment.extra.block') }}
                                </button>
                                <div class="modal fade" id="confirm-block-pre{{ $comment->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">{{ __('admin/CMS/Blog/Comment/article_comment.extra.confirm_block') }}</p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>{{ __('admin/CMS/Blog/Comment/article_comment.extra.Are you sure you want block this item') }}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">{{ __('admin/CMS/Blog/Comment/article_comment.extra.close') }}</button>
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="block_deleted">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/CMS/Blog/Comment/article_comment.extra.yes') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirm-delete-permanently{{ $comment->id }}">
                                    <i class="fas fa-trash p-2"></i>{{ __('admin/CMS/Blog/Comment/article_comment.buttons.delete') }}
                                </button>
                                <div class="modal fade" id="confirm-delete-permanently{{ $comment->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">{{ __('admin/CMS/Blog/Comment/article_comment.extra.confirm_delete') }}</p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>{{ __('admin/CMS/Blog/Comment/article_comment.extra.Are you sure you want delete this item') }}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">{{ __('admin/CMS/Blog/Comment/article_comment.extra.close') }}</button>
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="deleted">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/CMS/Blog/Comment/article_comment.extra.yes') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirm-delete-all-pre{{ $comment->id }}">
                                    <i class="fas fa-trash p-2"></i>{{ __('admin/CMS/Blog/Comment/article_comment.extra.Delete all comments of this user') }}   
                                </button>
                                <div class="modal fade" id="confirm-delete-all-pre{{ $comment->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">{{ __('admin/CMS/Blog/Comment/article_comment.extra.confirm_delete') }}</p>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>{{ __('admin/CMS/Blog/Comment/article_comment.extra.Are you sure you want delete all comments of this user') }}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md"
                                                    data-dismiss="modal">{{ __('admin/CMS/Blog/Comment/article_comment.extra.close') }}</button>
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="delete_comment_all">
                                                    @method('DELETE')
                                                    
                                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/CMS/Blog/Comment/article_comment.extra.yes') }}</button>
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
