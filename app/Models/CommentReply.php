<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function comment()
    {
        return $this->belongsTo('\App\Models\Comment', 'comment_id');
    }

    public function author()
    {
        return $this->belongsTo('\App\Models\User', 'user_id');
    }
}
