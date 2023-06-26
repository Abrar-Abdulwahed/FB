@extends('layouts.admin')
@section('content')
@section('title')
    وسائل الدفع
@endsection
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
                @foreach ($payments as $payment)
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
                                <input type="submit" class="btn btn-sm btn-info submit-btn"
                                    value="{{ $payment->is_active === 1 ? 'تعطيل' : 'تفعيل' }}">
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
<script>
    let forms = document.querySelectorAll('.my-form');
    // console.log(forms);

    forms.forEach(form => {
        form.addEventListener('submit', event => {
            event.preventDefault();

            let formData = new FormData(form); 

            fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    // update the submit button value
                    let submitBtn = form.querySelector('.submit-btn');
                    submitBtn.value = (submitBtn.value === 'تفعيل') ? 'تعطيل' : 'تفعيل';
                })
                .catch(error => {
                    // handle the error
                });
        });
    });
</script>
@endpush
