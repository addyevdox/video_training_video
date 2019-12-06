<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoQuestion extends Model
{
    //

    protected $table = 'video_survey_questions';

    public function video() {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
