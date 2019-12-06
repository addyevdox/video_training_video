<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoAnswer extends Model
{
    //

    protected $table = 'video_survey_answers';

    public function answer() {
        return $this->belongsTo(VideoQuestion::class,'question_id');
    }

}
