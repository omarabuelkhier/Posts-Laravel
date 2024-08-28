<?php

namespace App\Models;

use App\Http\Requests\Comment;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{

 protected $fillable=['title','description','image','creator_id'];
    use HasFactory, SoftDeletes , Sluggable;

public function creator(){
    return $this->belongsTo(Creator::class,'creator_id');
}
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }



//    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(Comment::class);
//    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'separator' =>'-'
            ],
        ];
    }
    public function created_at_difference()
    {
        return Carbon::createFromTimestamp(strtotime($this->created_at))->diff(Carbon::now())->format('l dS F o H:i:s A');
    }
    public function HumanReadableCreatedAt()
    {
        return $this->created_at->format('dS M Y H:i:s A');
    }
}
