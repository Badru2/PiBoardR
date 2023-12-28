<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $tweets = Tweet::with('user', 'likes')->latest('id')->get();

        return view('dashboard', compact('tweets'));
    }
}
