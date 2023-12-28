<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle($id)
    {
        $tweet = Tweet::with('user')->findOrFail($id);
        $attr = ['user_id' => Auth::user()->id];

        if ($tweet->likes()->where($attr)->exists()) {
            $tweet->likes()->where($attr)->delete();
            $msg = ['status' => 'UNLIKE'];
        } else {
            $tweet->likes()->create($attr);
            $msg = ['status' => 'LIKE'];
        }

        return response()->json($msg);
    }
}
