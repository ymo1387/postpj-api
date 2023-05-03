<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    protected $fillable = ['name', 'info'];

    public $timestamps = false;

    // posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
