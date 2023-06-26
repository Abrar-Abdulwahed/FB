@extends('layouts.admin')

@section('title', 'قائمة الرسائل المخصصة')
@section('content')

    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif


    <style>
.message {
    padding: 10px;
    background-color: #f2f2f2;
    border-radius: 5px;
    margin-bottom: 10px;
}

.message p {
    
    margin: 0;
    font-size: 16px;
}

.user-avatar img {
    
    width: 80%;
    border-radius: 50%;
}

.admin-tag {
    background-color: #2c09ee;
    color: #fff;
    font-size: 12px;
    text-align: center;
    padding: 5px;
    border-radius: 5px;
    margin-top: 5px;
}
.admin-message {
    background-color: #3498db;
    color: #fff;
}
    </style>
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
                   الرسائل الخاصه بالتذكره
        </div>
    </br>
</br>

    <div class="container">
        <div class="row">
            <div class="col-2 text-center">
                <div class="user-avatar">
                    <img src="{{$ticket->user->avatar}}" alt="User avatar">
                    {{$ticket->user->name}}
                    @if($ticket->user->role=='admin')
                    <div class="admin-tag">Admin</div>
                    @else
                    <div class="admin-tag" style="background-color:#2ecc71">User</div>
                    @endif
                </div>
            </div>

            <div class="col-10">
                <div class="message @if($ticket->user->role=='admin') admin-message @endif">
                        <p>{{ $ticket->message }}</p>
                </div>
            </div>

        </div>
    </div>
</br>
@foreach ($ticket->messages as $message )
    <div class="container">
        <div class="row">
            <div class="col-2 text-center">
                <div class="user-avatar">
                    <img src="{{$message->user->avatar}}" alt="User avatar">
                    {{$message->user->name}}
                    @if($message->is_admin)
                    <div class="admin-tag">Admin</div>
                    @else
                    <div class="admin-tag" style="background-color:#2ecc71">User</div>
                    @endif
                </div>
            </div>

            <div class="col-10">
                <div class="message @if($message->is_admin) admin-message @endif">
                        <p>{{ $message->message }}</p>
                </div>
            </div>

        </div>
    </div>
</br>
    @endforeach
</br>
    <div class="container">
        <!-- Messages container -->
        <div class="messages-container">
            <!-- Display messages here -->
        </div>
        <!-- Form to send messages -->
        <form method="POST" action="{{route('admin.tickets.store')}}">
            @csrf
            <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
            <div class="form-group">
                <textarea class="form-control" name="message" placeholder="Type your message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">ارسال</button>
        </form>
    </div>

@endsection
