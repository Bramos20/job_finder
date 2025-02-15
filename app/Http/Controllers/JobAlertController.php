<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobAlert;

class JobAlertController extends Controller
{
    public function showSubscriptionForm()
    {
        return view('job_alerts.subscribe');
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'category' => 'nullable|string'
        ]);

        JobAlert::create($request->only(['email', 'category']));

        return back()->with('success', 'You have successfully subscribed to job alerts!');
    }
}
