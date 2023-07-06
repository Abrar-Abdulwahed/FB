<?php

namespace App\Http\Controllers\Guest\CMS\FAQ;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();

        return view('guest.cms.faqs.index', compact('faqs'));
    }
}
