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

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            Group::class,
            'category_id', // Foreign key on the groups table.
            'id',          // Foreign key on the group_user table.
            'id',          // Local key on the categories table.
            'id'           // Local key on the groups table (to be used with group_user.group_id).
        );
    }
}
