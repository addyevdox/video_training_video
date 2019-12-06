<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoComment extends Model
{
    protected $table = 'video_comments';

    public function video() {
        return $this->belongsTo(Video::class, 'video_id');
    }

}
