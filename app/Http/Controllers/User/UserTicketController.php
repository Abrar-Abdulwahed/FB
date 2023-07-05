<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\StoreTicketRequest;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserTicketController extends Controller
{

    public function index()
    {
        $user_id = Auth::user()->id;
        $tickets = Ticket::with('category', 'user')->where('user_id', $user_id)->get();
        return view("users.tickets.index", compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with('user', 'category')->find($id);
        $ticket->messages = TicketMessage::with('user')->where('ticket_id', $id)->get();
        return view('users.tickets.show', compact('ticket'));
    }

    public function create()
    {
        $categories = TicketCategory::get();
        return view("users.tickets.create", compact('categories'));
    }

    public function store(StoreTicketRequest $request)
    {
        $user_id = auth()->id();
        $ticket = Ticket::create([
            'user_id' => $user_id,
            'ticket_category_id' => $request->type,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        if ($ticket) {
            return redirect()->route("ticket.create")->with('success', 'تمت اضافه التذكره بنجاح');
        }

    }
}
