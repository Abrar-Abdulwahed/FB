@extends('layouts.admin')
@section('title')
    اضافة صفحة
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins\bootstrap-switch\css\bootstrap3\bootstrap-switch.min.css') }}">
@endpush

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            اضافة صفحة جديد
        </div>
        <div class="card-body">

            <form action="{{ Route('admin.pages.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row col-12">

                    <div class="form-group col-12">
                        <label>العنوان</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>المحتوى</label>
                        <textarea name="content" id="content" class="form-control ckeditor">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>الوصف</label>
                        <textarea name="description" id="description" class="form-control ckeditor">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- <div class="form-group col-12">
                        <label>الصورة</label>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    {{-- <div class="custom-control custom-switch">
                        <input data-id="{{$product->id}}" name="is_in_menu" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $product->status ? 'checked' : '' }}> 

                        <label class="">In menu</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input data-id="{{$product->id}}"  name="is_in_footer" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $product->status ? 'checked' : '' }}> 

                        <label class="">In footer</label>
                    </div> --}}

                    <div class="custom-control custom-switch mx-3 mt-2 col-12">
                        <input type="checkbox" @checked(old('is_in_footer')) class="custom-control-input" id="is_in_footer" name="is_in_footer">
                        <label class="custom-control-label" for="is_in_footer">في ال footer</label>
                    </div>

                    <div class="custom-control custom-switch mx-3 my-2 col-12">
                        <input type="checkbox" @checked(old('is_in_menu')) class="custom-control-input" id="is_in_menu" name="is_in_menu">
                        <label class="custom-control-label" for="is_in_menu">في القائمة</label>
                    </div>
                    

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">
                            اضافة</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
  

  <!-- Bootstrap Switch -->
  <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
  <script>
      // $(document).ready(function() {
      //     $("[data-bootstrap-switch]").bootstrapSwitch();
      // });

      $(function() {

          $("input[data-bootstrap-switch]").each(function() {
              $(this).bootstrapSwitch('state', $(this).prop('checked'));
          })

      })
  </script>
@endpush
