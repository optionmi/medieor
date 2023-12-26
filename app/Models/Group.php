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
}
