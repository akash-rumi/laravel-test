<?php

namespace App;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\DeletedAdminScope;
use App\Traits\Taggable;
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
    use SoftDeletes, Taggable;

    protected $table = 'blogposts';
    protected $fillable = ['title', 'content', 'user_id', 'created_at'];

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function scopeLatestWithRelations(Builder $query)
    {
        return $query->latest()->withCount('comments')->with('user')->with('tag');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public static function boot()
    {

        static::addGlobalScope(new DeletedAdminScope);
        parent::boot();

        // // static::addGlobalScope(new LatestScope);
        // static::deleting(function (BlogPost $blogPost) {
        //     $blogPost->comments()->delete();
        //     Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        // });

        // static::updating(function (BlogPost $blogPost) {
        //     Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        // });

        // static::restoring(function (BlogPost $blogPost) {
        //     $blogPost->comments()->restore();
        // });
    }
}
