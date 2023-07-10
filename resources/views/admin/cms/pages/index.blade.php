@extends('layouts.admin')
@section('content')
@section('title')
    الصفحات
@endsection

<a href={{ route('admin.pages.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
    اضافة صفحة</a>
<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        الصفحات
    </div>
    <div class="card-body table-responsive">

        <table class="table table-striped text-center" id="pages">
            <thead>
                <tr>
                    <th>العنوان</th>
                    <th>الحالة</th>
                    <th>اجراءات</th>
                </tr>
            </thead>
            <tbody>

            <tbody>
                @foreach ($pages as $index =>$page)
                    <tr>
                        <td><a target="_blank" href="{{ route('guest.pages.show', $page->slug) }}">{{ $page->title }}</a>
                        </td>
                        <td>
                            <form class="my-form" action="{{ route('admin.pages.changeActive', $page->id) }}"
                                method="post">
                                @csrf
                                @method('PATCH')

                                <div class="form-group col-12 mr-3 custom-control custom-switch my-4">
                                    <input type="checkbox" class="custom-control-input"
                                        id="is-active-{{ $index }}" name="is_active"
                                        @checked($page->is_active == 1)>
                                    <label class="custom-control-label" for="is-active-{{ $index }}"></label>
                                </div>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="mx-1 btn btn-success"><i
                                    class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-delete-{{ $page->id }}">
                                <i class="fas fa-trash p-2"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $page->id }}">
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
                                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST">
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
@push('js')
    <script src="{{ asset('js/previewImage.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $(function() {

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        })

        let forms = document.querySelectorAll('.my-form');

        forms.forEach(form => {
            let switchBtn = form.querySelector('.custom-switch input[type="checkbox"]');
            switchBtn.addEventListener('change', function() {
                form.submit();
            });
        });
    </script>
@endpush
