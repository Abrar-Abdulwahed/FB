<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\PaymentMethod;
use App\Models\Ticket;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users_count = User::count();
        $articles_count = Article::count();
        $tickets_count = Ticket::count();
        $payment_methods = PaymentMethod::count();

        return view('admin.index', compact('users_count', 'articles_count', 'tickets_count', 'payment_methods'));
    }
}
