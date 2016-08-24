<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table = 'cates';
    protected $fillable = [
        'name', 'slug', 'keywords', 'description', 'parent_id', 'status'
    ];

    public function posts()
    {
        return $this->hasMany('App\Post', 'cate_id', 'id')->where('status', 1)->orderBy('id', 'DESC');
    }

    public function cates()
    {
        return $this->hasMany('App\Cate', 'parent_id', 'id');
    }
}
