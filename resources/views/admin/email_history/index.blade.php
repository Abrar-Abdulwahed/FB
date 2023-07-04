@extends('layouts.admin')

@section('title', 'سجل رسائل البريد الإلكتروني المرسلة للمستخدم')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            سجل رسائل البريد الإلكتروني المرسلة للمستخدم
        </div>
        <div class="card-body table-responsive">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>إلى</th>
                                    <th>العنوان</th>
                                    <th>تايخ الإرسال</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($emails as $item)
                                    <tr>
                                        <td class="mailbox-#">{{ $loop->iteration }}
                                        </td>
                                        <td class="mailbox-name">{{ $item->recipient }}</td>
                                        <td class="mailbox-subject">
                                            <a href="{{ route('admin.history.show', $item->id) }}" target="_blank"
                                                class="text-dark">
                                                <b>{{ $item->title }}</b>
                                                -
                                                <span
                                                    class="text-muted">{{ \Str::limit(str_replace('userName', $item->recipient, $item->custom_message->text), 100, '...') }}</span>
                                            </a>
                                        </td>
                                        <td class="mailbox-date">{{ $item->created_at->diffForHumans() }} </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-danger text-center">لا توجد رسائل بعد
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    {!! $emails->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
