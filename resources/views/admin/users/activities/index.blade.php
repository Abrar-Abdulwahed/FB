@extends('layouts.admin')
@section('content')
@section('title')
{{ __('admin/users/user.pages.index') }}
@endsection

<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        {{ __('admin/users/user.pages.user_activities') }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-center" id="users-activities">
                <thead>
                    <tr>
                        {{-- <th style="width: 10px">#</th> --}}
                        <th>Description</th>
                        <th>Subject type</th>
                        <th>Properties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            {{-- <td>{{ $activity->id }}</td> --}}
                            <td>{{ $activity->description }}</td>
                            <td>{{ $activity->subject_type }}</td>
                            <td>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>status</th>
                                            @foreach ($activity->properties as $values)
                                                @foreach ($values as $key => $value)
                                                    <th>{{ $key }}</th>
                                                @endforeach
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($activity->properties as $key => $values)
                                            <tr>
                                                <td>{{ $key === 'old' ? 'old' : 'new' }}</td>
                                                @foreach ($values as $value)
                                                    <td>{{ $value }}</td>
                                                @endforeach

                                            </tr>
                                        @empty
                                            لا يوجد تغيير
                                        @endforelse
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
