<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PeterColes\Countries\CountriesFacade as Countries;

class Donation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getCountryNameAttribute()
    {
        if ($this->country) {
            return Countries::countryName($this->country, 'en');
        }
    }
}
