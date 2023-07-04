@if (session('success'))
    <p class="alert alert-success" role="alert">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p class="alert alert-danger">{{ session('error') }}</p>
@endif

@if (count($errors) > 0)
    <p class="alert alert-danger">{{ $errors->first() }}</p>
@endif
