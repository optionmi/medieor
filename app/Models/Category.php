<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function groups()
    {
        return $this->hasMany(Group::class, 'category_id');
    }
    public function active_groups()
    {
        return $this->hasMany(Group::class, 'category_id')->where('status', 1)->orderBy('created_at', 'desc');
    }
    // public function users()
    // {
    //     return $this->hasManyThrough(
    //         User::class,
    //         Group::class,
    //         'category_id', // Foreign key on the groups table.
    //         'id',          // Foreign key on the group_user table.
    //         'id',          // Local key on the categories table.
    //         'id'           // Local key on the groups table (to be used with group_user.group_id).
    //     );
    // }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function mostPopularTopics()
    {
        return $this->hasMany(Topic::class)
            ->join('category_posts', 'topics.id', '=', 'category_posts.topic_id')
            ->orderBy('category_posts.comment_count', 'desc');
    }

    public function getUsersAttribute()
    {
        // return $this->groups()->with('users')->get()->pluck('users')->unique('id');
        return User::whereHas('groups.category', function ($query) {
            $query->where('id', $this->id);
        })->get();
    }

    public function events()
    {
        return $this->hasMany(Event::class)->orderBy('created_at', 'desc');
    }

    public function articles()
    {
        return $this->hasMany(Article::class)->orderBy('created_at', 'desc');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_categories');
    }
}
