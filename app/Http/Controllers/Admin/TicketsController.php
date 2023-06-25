<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index(){
        $tickets = Ticket::with('user', 'category')->get();
        return view('admin.tickets.index',compact('tickets'));
    }

    
}
