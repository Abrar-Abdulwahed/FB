<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UserEmailHistory;
use App\Http\Controllers\Controller;

class EmailHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails = UserEmailHistory::with('custom_message')->paginate(1);
        return view('admin.email_history.index', compact('emails'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $email = UserEmailHistory::with('custom_message')->findOrFail($id);
        return view('admin.email_history.show', compact('email'));
    }
}
