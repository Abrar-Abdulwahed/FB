<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    public function index(){
        $tickets = Ticket::with('user', 'category')->get();
        return view('admin.tickets.index',compact('tickets'));
    }


    public function show($id){
        $ticket=Ticket::with('user', 'category')->find($id); 
        $ticket->messages=TicketMessage::with('user')->where('ticket_id', $id)->get();;
        // dd($ticket->messages);
        return view('admin.tickets.show',compact('ticket'));
    }

    public function store(Request $request){
        $user_id = auth()->id();
        $user_role = Auth::user()->role;
        if ($user_role=='admin') {
            $role=1;
        }else{
            $role=0;
        }
        $message=TicketMessage::create([
            'ticket_id'=>$request->ticket_id,
            'user_id'=>$user_id,
            'message'=>$request->message,
            'is_admin'=>$role
        ]);
        return redirect()->back();
    }

    
}
