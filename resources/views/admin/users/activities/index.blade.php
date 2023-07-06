@extends('layouts.admin')
@section('content')
@section('title')
    الأعضاء
@endsection

<div class="clearfix"></div>
@include('partials.session')
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        نشاطات الأعضاء
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Description</th>
                        <th>Subject type</th>
                        <th>Properties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td>{{ $activity->id }}</td>
                            <td>{{ $activity->description }}</td>
                            <td>{{ $activity->subject_type }}</td>
                            <td>
                                <table>
                                    <thead>
                                        {{-- <tr>
                                            <th>status</th>
                                            <th>name</th>
                                            <th>email</th>
                                            <th>avatar</th>
                                            <th>is_banned</th>
                                            <th>banned_until</th>
                                        </tr> --}}
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
