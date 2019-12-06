<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    //

    protected $table = 'videos';

    protected $guarded = ['id'];


    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }
    public function question()
    {
        return $this->hasMany(VideoQuestion::class);
    }
}
