<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title', 'slug', 'image', 'body', 'keywords', 'description', 'status', 'view', 'ratePoint', 'rateCount', 'tags', 'cate_id', 'user_id'
    ];

    public function cate()
    {
        return $this->belongsTo('App\Cate');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->where('comment_id', 0)->where('status', 1)->orderBy('id', 'DESC');
    }
}
