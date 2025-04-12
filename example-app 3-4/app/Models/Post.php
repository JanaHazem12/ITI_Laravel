<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    //
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    } 
    public $timestamps = true;
    protected $fillable = ['title', 'description', 'user_id'];


    public function user()
    {
        // $post->user->name instead of using $user->name
        return $this->belongsTo(User::class);
    }

    // THIS MODEL(POST) HAS MANY COMMENTS
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // public function comments(): MorphMany
    // {
    //     return $this->morphMany(Comment::class, 'commentable');
    // }
    // THIS FUNCTION IS USED WHEN COMMENTS IS SHAREABLE AMONG MANY OTHER MODELS
    // it should have col. commentable_type: stores the type of the related model


}
