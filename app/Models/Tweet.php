<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Usamamuneerchaudhary\Commentify\Models\Comment;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Tweet extends Model
{
    use HasFactory;
    use Commentable;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function is_liked()
    {
        return $this->likes->where('user_id', Auth::user()->id)->count();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function is_favorited()
    {
        return $this->favorites->where('user_id', Auth::user()->id)->count();
    }
}
