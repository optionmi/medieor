<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

    public function media()
    {
        return $this->hasMany('\App\Models\PostMedia', 'post_id');
    }

    public function group()
    {
        return $this->belongsTo('\App\Models\Group');
    }

    public function comments()
    {
        return $this->hasMany('\App\Models\Comment', 'post_id');
    }

    public function likes()
    {
        return $this->hasMany('\App\Models\Like', 'post_id');
    }

    public function getUserHasLikedAttribute()
    {
        return $this->likes()->where('user_id', '=', auth()->user()->id)->exists();
    }
}
