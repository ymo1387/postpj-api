<?php

namespace App\Models;

use App\Models\User;
use App\Models\PostText;
use App\Models\PostType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['post_type_id', 'title'];

    // post maker
    public function maker()
    {
        return $this->belongsTo(User::class);
    }

    // post type
    public function type()
    {
        return $this->belongsTo(PostType::class, 'post_type_id');
    }

    // post text
    public function text()
    {
        return $this->hasOne(PostText::class);
    }
}
