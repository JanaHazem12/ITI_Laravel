<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{

    public function user()
    {
        // $post->user->name instead of using $user->name
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    //
    // public function commentable(): MorphTo
    // {
    //     return $this->morphTo();
    // }
}

