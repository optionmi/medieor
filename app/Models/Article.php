<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($article) {
            foreach ($article->media as $media) {
                $dir = 'images/articles/';
                // Delete the file from storage
                Storage::disk('public_dir')->delete($dir . $media);

                // Delete the media record
                $media->delete();
            }
        });
    }
}
