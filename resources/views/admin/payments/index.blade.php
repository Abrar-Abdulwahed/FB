@extends('layouts.admin')
@section('title')
    وسائل الدفع
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins\bootstrap-switch\css\bootstrap3\bootstrap-switch.min.css') }}">
@endpush

@section('content')
    <a href={{ route('admin.payments.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
        اضافة وسيلة دفع</a>
    <div class="clearfix"></div>
    @include('partials.session')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            وسائل الدفع
        </div>
        <div class="card-body">

            <table class="table table-striped text-center" id="payments">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>الحالة</th>
                        <th>اجراءات</th>
                    </tr>
                </thead>
                <tbody>

                <tbody>
                    @foreach ($payments as $index => $payment)
                        <tr>
                            <td>
                                <img class="img-rounded" src="{{ asset('storage/images/' . $payment->logo) }}"
                                    alt="{{ $payment->name }}" width="50px" height="50px">
                                {{ $payment->name }}
                            </td>
                            <td>
                                <form class="my-form" action="{{ route('admin.payments.changeActive', $payment->id) }}"
                                    method="post">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group col-12 mr-3 custom-control custom-switch my-4">
                                        <input type="checkbox" class="custom-control-input"
                                            id="is-active-{{ $index }}" name="is_active"
                                            @checked($payment->is_active == 1)>
                                        <label class="custom-control-label" for="is-active-{{ $index }}"></label>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.payments.edit', $payment->id) }}" class="mx-1 btn btn-success"><i
                                        class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirm-delete-{{ $payment->id }}">
                                    <i class="fas fa-trash p-2"></i>
                                </button>
                                <div class="modal fade" id="confirm-delete-{{ $payment->id }}">
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
                                                <form action="{{ route('admin.payments.destroy', $payment->id) }}"
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
