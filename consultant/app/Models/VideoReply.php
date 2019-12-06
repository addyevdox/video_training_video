<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoReply extends Model
{
    //

    protected $table = 'survey_replys';

    public function video() {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
