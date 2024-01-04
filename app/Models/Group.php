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
}
