<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TweetShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id): View
    {
        $tweet = Tweet::where('id', $id)->first();

        return view("pages.show", compact("tweet"));
    }
}
