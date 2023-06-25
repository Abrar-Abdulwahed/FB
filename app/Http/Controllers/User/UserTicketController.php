<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class UserTicketController extends Controller
{
    public function create()
    {
        $categories=TicketCategory::get();
       return view("users.tickets.create",compact('categories'));
    }

    public function store(StoreTicketRequest $request)
    {
        $user_id = auth()->id();
        $ticket=Ticket::create([
            'user_id'=>$user_id,
            'ticket_category_id'=>$request->type,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ]);
        if ($ticket) {
            return redirect()->route("ticket.create")->with('success','تمت اضافه التذكره بنجاح');
        }
        
    }
}
