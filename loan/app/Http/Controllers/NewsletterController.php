<?php

// app/Http/Controllers/NewsletterController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscribed;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Optional: save to DB
        // NewsletterSubscriber::create($request->only('email'));

        Mail::to($request->email)->send(new NewsletterSubscribed());

        return response()->json([
            'success' => true,
            'message' => 'Thank you! You\'re subscribed.'
        ]);
    }
}
