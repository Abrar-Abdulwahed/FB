<?php

namespace App\Http\Controllers\Admin\Support;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user', 'category')->get();
        return view('admin.support.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with('user', 'category')->find($id);
        //get roles of user
        $user = User::with('roles')->find($ticket->user->id);
        //check if user is admin
        $is_admin = 0;
        foreach ($user->roles as $role) {
            if ($role->name == "admin") {
                $is_admin = 1;
            }
        }
        //append the role to the creator of ticket
        $ticket->is_admin = $is_admin;
        $ticket->messages = TicketMessage::with('user')->where('ticket_id', $id)->get();
        // dd($ticket->messages);
        return view('admin.support.show', compact('ticket'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::with('roles')->find($user_id);
        $is_admin = 0;

        foreach ($user->roles as $role) {
            if ($role->name == "admin") {
                $is_admin = 1;
            }
        }

        $message = TicketMessage::create([
            'ticket_id' => $request->ticket_id,
            'user_id' => $user_id,
            'message' => $request->message,
            'is_admin' => $is_admin,
        ]);
        return redirect()->back();
    }

}
