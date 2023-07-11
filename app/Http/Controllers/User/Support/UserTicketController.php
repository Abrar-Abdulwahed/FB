<?php

namespace App\Http\Controllers\User\Support;

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
        return view("user.tickets.index", compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with('user', 'category')->find($id);
        $ticket->messages = TicketMessage::with('user')->where('ticket_id', $id)->get();
        return view('user.tickets.show', compact('ticket'));
    }

    public function create()
    {
        $categories = TicketCategory::get();
        return view("user.tickets.create", compact('categories'));
    }

    public function store(StoreTicketRequest $request)
    {
        $validated = $request->validated();

        $validated = array_merge($validated, [
            'user_id' => $request->user()->id
        ]);

        Ticket::query()->create($validated);

        $ticket = Ticket::first();
        if($ticket->is_admin==0){
            $ticket->update(['status'=>1]);
        }

        return redirect()->route('user.ticket.index')->with('success', 'تمت اضافه التذكره بنجاح');
    }
}
