<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogSetting extends Model
{
    protected $table = 'blog_settings';
    protected $fillable = [
        'key', 'name', 'value'
    ];
    public $timestamps = false;
}
