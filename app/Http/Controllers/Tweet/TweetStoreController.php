<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetStoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'file'     => 'nullable|file|mimes:jpeg,jpg,png,mp4,mp3,gif,svg,webp',
            'content'   => 'nullable|min:1'
        ]);

        $file = $request->file('file');

        if ($file) {
            $file->storeAs('public/tweets', $file->hashName());
            $filePath = $file->hashName();
        } else {
            $filePath = null;
        }

        Tweet::create([
            'user_id' => Auth::id(),
            'file'   => $filePath,
            'content' => request('content')
        ]);

        // toast('Tweet created successfully', 'success');

        return redirect("/");
    }
}
