<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'image',
        'title',
        'slug',
        'content',
        'category_id',
        'user_id',
        'published_at',
    ];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function claps()
    {
        return $this->hasMany(Clap::class);
    }

    public function imageUrl()
    {
        if (!$this->image) {
            return asset('images/placeholder.jpg');
        }

        try {
            if (Storage::disk('public')->exists($this->image)) {
                return asset('storage/' . $this->image);
            }
            return asset('images/placeholder.jpg');
        } catch (\Exception $e) {
            Log::error('Error retrieving image URL: ' . $e->getMessage());
            return asset('images/placeholder.jpg');
        }
    }
}
