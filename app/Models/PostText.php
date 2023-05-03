<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostText extends Model
{
    protected $fillable = ['body'];

    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
