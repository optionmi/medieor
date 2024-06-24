<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['formated_created_at'];

    public function getFormatedCreatedAtAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function comments()
    {
        return $this->hasMany(CPComment::class, 'post_id');
    }
}
