<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function toggle($id)
    {
        $tweet = Tweet::with('user')->findOrFail($id);
        $attr = ['user_id' => Auth::user()->id];

        if ($tweet->favorites()->where($attr)->exists()) {
            $tweet->favorites()->where($attr)->delete();
            $msg = ['status' => 'UNFAVORITE'];
        } else {
            $tweet->favorites()->create($attr);
            $msg = ['status' => 'FAVORITE'];
        }

        return response()->json($msg);
    }
}
