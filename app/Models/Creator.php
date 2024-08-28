<?php

namespace App\Models;

use App\Http\Requests\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Creator extends Model
{

    use HasFactory;
public function posts()
{
    return $this->hasMany(post::class);
}
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
