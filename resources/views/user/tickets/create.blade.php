@extends('layouts.user')
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
            إنشاء رسالة
        </div>
        <div class="card-body">
            <form id="quickForm" method="POST" action={{ route('user.ticket.store') }}>
                @csrf
                <div class="form-group mt-4">
                    <label for="message">العنوان</label>
                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}"
                        placeholder="العنوان">
                    @error('subject')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-row mt-4">
                    <div class="form-group col-md-12">
                        <label for="type">النوع</label>
                        <select class="form-control" name="ticket_category_id" id="type">
                            <option value="">اختر نوع الرسالة</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('ticket_category_id') == $category->id)>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ticket_category_id')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="form-group mt-4">
                    <label for="message">النص</label>
                    <textarea class="form-control" id="text" rows="3" name="message" placeholder="اكتب النص هنا">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="text">النص</label>
                    <textarea id="summernote" name="text">
                        اكتب النص هنا
                    </textarea>
                </div> --}}
                <button type="submit" class="btn btn-dark">إضافة</button>
            </form>
        </div>
    </div>
@endsection
