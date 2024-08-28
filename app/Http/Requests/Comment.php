<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;
      protected $fillable=[''];
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

//
//    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(Post::class);
//    }
}
