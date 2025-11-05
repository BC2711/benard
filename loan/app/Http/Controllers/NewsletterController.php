<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscribed;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email'
        ]);


        NewsletterSubscriber::create(['email' => $request->email]);

        Mail::to($request->email)->send(new NewsletterSubscribed());

        return response()->json([
            'success' => true,
            'message' => 'Thank you! You\'re subscribed to our newsletter.'
        ]);
    }
}
