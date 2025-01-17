<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    public static function boot()
    {
        parent::boot();

        // registering a callback to be executed upon the creation of a new post
        static::creating(function($post) {

            // produce a slug based on the post title
            $slug = Str::slug($post->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $post->slug = $count ? "{$slug}-{$count}" : $slug;
        });

    }
}
