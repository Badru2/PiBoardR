<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TweetDeleteController extends Controller
{
    public function __invoke($id): RedirectResponse
    {
        $tweet = Tweet::findOrFail($id);

        Storage::delete('public/tweets/' . $tweet->file);

        $tweet->delete();

        return redirect()->back();
    }
}
