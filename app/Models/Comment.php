<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsTo('\App\Models\Post', 'post_id');
    }

    public function author()
    {
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

    public function replies()
    {
        return $this->hasMany('\App\Models\CommentReply', 'comment_id');
    }
}
