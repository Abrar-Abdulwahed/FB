@extends('layouts.admin')

@section('title', 'قائمة التذاكر')
@section('content')
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            قائمة التذاكر
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>اسم المستخدم</th>
                        <th>العنوان</th>
                        <th>النوع</th>
                        <th>النص</th>
                        <th>الحاله</th>
                        <th style="width:100px">العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->subject }}</td>
                            <td><span
                                    class="badge bg-success">{{ $item->category->name }}</span>
                            </td>
                            <td>{{ \Str::limit($item->message, 50, '...') }}</td>
                            
                            @if ($item->status)
                            <td><span class="badge bg-success">
                                open
                            </span>
                        </td>
                            @else
                            <td><span class="badge bg-danger">
                                closed
                            </span>
                        </td>
                            @endif

                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('admin.tickets.show',$item->id)}}"
                                        class="mx-1 btn btn-success">مشاهده الرساله</i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center">لا توجد تذاكر بعد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
