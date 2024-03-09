<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['formated_created_at'];

    public function getFormatedCreatedAtAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }
}
