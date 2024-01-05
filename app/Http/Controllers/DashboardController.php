<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tweets = Tweet::with('user', 'likes', 'favorites')->latest('id')->paginate(5);

        if ($request->ajax()) {
            $view = view('components.tweets-with-foreach', compact('tweets'))->render();

            return response()->json(['html' => $view]);
        }

        return view('dashboard', compact('tweets'));
    }
}
