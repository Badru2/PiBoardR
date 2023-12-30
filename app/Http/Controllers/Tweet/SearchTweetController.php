<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;

class SearchTweetController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $search = $request->get("search");

        $searchTweet = Tweet::with('user', 'likes')->where('content', 'like', "%" . $search . "%")->orderBy('id', 'desc')->paginate();
        $searchUser = User::where('name', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate();

        return view('pages.search', ['tweets' => $searchTweet, 'users' => $searchUser], compact('search'));
    }
}
