<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function media()
    {
        return $this->hasMany(EventMedia::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($event) {
            foreach ($event->media as $media) {
                $dir = $media->media_type == 'image' ? 'images/events/' : 'videos/events/';
                // Delete the file from storage
                Storage::disk('public_dir')->delete($dir . $media->media_file);

                // Delete the media record
                $media->delete();
            }
        });
    }
}
