<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoQuestion;
use App\Models\VideoAnswer;
use PhpParser\Node\Expr\Array_;

class SurveyController extends Controller
{
    public function index($id)
    {
        $questions = VideoQuestion::where('video_id', $id)->get();
        foreach ($questions as $question ) {
            $answer = VideoAnswer::where('question_id', $question->id)->get();
            $question->answer = $answer;
        }
        return view('survey.index', compact('questions'));
    }

    public function reply() {
        return view('thank');
    }
}
