<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Categories()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function userRequest()
    {
        return $this->belongsToMany('\App\Models\User', 'group_user', 'group_id', 'user_id')->wherePivot('status', 0);
    }

    public function users()
    {
        return $this->belongsToMany('\App\Models\User', 'group_user', 'group_id', 'user_id')->wherePivot('status', 1);
    }

    public function posts()
    {
        return $this->hasMany('\App\Models\Post', 'group_id')->orderBy('created_at', 'desc');
    }

    public function getTodayPostCountAttribute()
    {
        return $this->posts()->whereDate('created_at', date('Y-m-d'))->count();
    }

    public function latestUsers()
    {
        return $this->belongsToMany('\App\Models\User', 'group_user', 'group_id', 'user_id')->wherePivot('status', 1)->orderBy('created_at', 'desc');
    }

    public function getUsersJoinedMessageAttribute()
    {
        $users = $this->latestUsers()->get();
        $userCount = $users->count();
        if ($userCount > 2) {
            $firstUserName = $users[0]->name;
            $secondUserName = $users[1]->name;
            $othersCount = $userCount - 2; // Subtract the first two users
            $message = "{$firstUserName}, {$secondUserName} and {$othersCount} others have joined";
        } elseif ($userCount == 2) {
            $firstUserName = $users[0]->name;
            $secondUserName = $users[1]->name;
            $message = "{$firstUserName} and {$secondUserName} have joined";
        } elseif ($userCount == 1) {
            $firstUserName = $users[0]->name;
            $message = "{$firstUserName} has joined";
        } else {
            $message = "No users have joined";
        }
        return $message;
    }
}
