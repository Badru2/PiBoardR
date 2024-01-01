<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Usamamuneerchaudhary\Commentify\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        $accept = $request->user();
        $accept = $request->user()->email == "admin@gmail.com";

        $user = $request->user();
        $tweets = $user->tweets()->with('likes', 'user', 'favorites')->latest('id')->get();

        $user = Auth::user();

        // Mengambil tweet yang sudah di-like oleh pengguna
        $favoritedTweets = Tweet::whereHas('favorites', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['favorites' => function ($query) {
            $query->orderByDesc('id');
        }])->get();


        return view('profile.profile', [
            'user' => $user,
            'tweets' => $tweets,
            'accept' => $accept,
            'favoritedTweets' => $favoritedTweets,
        ]);
    }

    public function show($name): View
    {
        $user = User::with('tweets')->where('name', $name)->first();
        if (!$user) abort(404);

        $tweets = $user->tweets()->with('likes', 'user', 'favorites')->latest('id')->get();

        $favoritedTweets = Tweet::whereHas('favorites', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['favorites' => function ($query) {
            $query->orderByDesc('id');
        }])->get();

        return view('profile.profile', [
            'user' => $user,
            'tweets' => $tweets,
            'favoritedTweets' => $favoritedTweets,
        ]);
    }

    public function follow($following_id)
    {
        $user = Auth::user();

        if ($user->following->contains($following_id)) {
            $user->following()->detach($following_id);
            $msg = ['status' => 'UNFOLLOW'];
        } else {
            $user->following()->attach($following_id);
            $msg = ['status' => "FOLLOW"];
        }

        return response()->json($msg);
    }


    public function edit(Request $request): View
    {

        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|alpha_dash|unique:users,name,' . $user->id,
            'fullName' => 'max:30',
            'bio' => 'max:200',
            'avatar' => 'image|mimes:jpeg,jpg,png',
        ]);

        $imageName = $user->avatar;
        if ($request->avatar) {
            $avatar_img = $request->avatar;
            $imageName = $user->name . '-' . time() . '.' . $avatar_img->extension();
            $avatar_img->move(public_path('images/avatar'), $imageName);
        }

        $user->update([
            'name' => $request->name,
            'fullName' => $request->fullName,
            'bio' => $request->bio,
            'avatar' => $imageName,
        ]);

        return redirect('/profile');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
