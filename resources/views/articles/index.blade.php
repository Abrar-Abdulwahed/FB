@extends('layouts.admin')
@section('content')
@section('title')
    الأعضاء
@endsection
<div class="container-fluid">

    <div class="col-lg-12">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible  show" role="alert">
                <strong>Success :</strong><?php echo Session::get('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <a href="{{ route('articles.create') }}" class="btn btn-sm btn-success my-3" title="add"><i
                style="font-size: 15px;" class="fa-solid fa-plus p-2 m-1"> </i>اضافة مقال</a>
        <div class="card">
            <div class="card-block p-4">
                <table class="table table-striped text-center" id="articles">
                    <thead>
                        <tr>
                            <th>العنوان</th>
                            <th>الوصف</th>
                            <th>المحتوى</th>
                            <th>الصورة</th>
                            <th>اجراءات</th>
                        </tr>
                    </thead>
                    <tbody>

                    <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <td>{{ $article->title }}</td>
                                <td>{{ \Str::limit($article->description, 50, '...') }} </td>
                                <td>{{ \Str::limit($article->content, 50, '...') }} </td>
                                <td>
                                    <img src="{{ $article->image_path }}" alt="{{ $article->title }}"
                                        class="img-fluid rounded">
                                </td>
                                <td>

                                    <form action="{{ route('articles.destroy', $article['id']) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-sm btn-info"
                                            title="edit"><i style="font-size: 15px;"
                                                class="fa-solid fa-pen p-1"></i></a>
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('{{ __('Are you sure you want delete this articles?') }}')"><i
                                                style="font-size: 15px;" class="fa-solid fa-trash"></i></button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
