@extends('layouts.admin')

@section('title', 'قائمة الرسائل المخصصة')
@section('content')
    <a href={{ route('admin.custom-message.create') }} class="btn btn-info float-right mb-2"> <i class="fa-solid fa-plus"></i>
        إضافة</a>
    <div class="clearfix"></div>
    @include('partials.session')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            قائمة الرسائل المخصصة
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>الرمز</th>
                        <th>العنوان</th>
                        <th>اللغة</th>
                        <th>النوع</th>
                        <th>النص</th>
                        <th>الحالة</th>
                        <th style="width:100px">العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->subject }}</td>
                            <td>{{ $item->language }}</td>
                            <td><span
                                    class="badge {{ $item->type == 'sms' ? 'bg-danger' : 'bg-success' }}">{{ $item->type }}</span>
                            </td>
                            <td>{!! \Str::limit($item->text, 50, '...') !!}</td>
                            <td>
                                <form class="enable-message-form"
                                    action="{{ route('admin.custom-message.changeActive', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group col-12 mr-3 custom-control custom-switch my-4">
                                        <input type="text" class="custom-control-input" name="is_active" value="off">
                                        <input type="checkbox" class="custom-control-input"
                                            id="is-active-{{ $loop->index }}" name="is_active" {{-- @disabled($item->disactivable() === false) --}}
                                            @checked($item->is_active == 1)>
                                        <label class="custom-control-label" for="is-active-{{ $loop->index }}"></label>
                                    </div>
                                </form>
                            </td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.custom-message.edit', $item->id) }}"
                                        class="mx-1 btn btn-success"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="mx-1 btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#confirm-delete-{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="confirm-delete-{{ $item->id }}">
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
                                                    <form action="{{ route('admin.custom-message.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark btn-md">نعم</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center">لا توجد رسائل بعد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {!! $messages->links() !!}
        </div>
    </div>
@endsection

@push('js')
    <script>
        let forms = document.querySelectorAll('.enable-message-form');

        forms.forEach(form => {
            let switchBtn = form.querySelector('.custom-switch input[type="checkbox"]');
            switchBtn.addEventListener('change', function() {
                form.submit();
            });
        });
    </script>
@endpush
