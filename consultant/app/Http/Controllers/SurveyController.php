<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Models\VideoQuestion;
use App\Models\VideoAnswer;
use App\Models\VideoReply;
use App\Models\Training;
use Mockery\Exception;
use PhpParser\Node\Expr\Array_;
use Sentinel;
use Redirect;


class SurveyController extends Controller
{
    public function index($id)
    {
        $user_id = Sentinel::getUser()->id;
        $check_complete = Training::where('video_id', $id)->where('user_id', $user_id)->count();
        if($check_complete < 1) {
            $result = new Training();
            $result->video_id = $id;
            $result->user_id = $user_id;
            $result->status = "Yes";
            $result->save();
        }
        $questions = VideoQuestion::where('video_id', $id)->get();
        if(!$questions->isEmpty()) {
            foreach ($questions as $question ) {
                $answer = VideoAnswer::where('question_id', $question->id)->get();
                if(!$answer->isEmpty()) {

                    $question->answer = $answer;
                }

            }
            return view('survey.index', compact('questions'));
        }

        return Redirect::back()->withInput()->with('info', "Survey is not ready");
    }

    public function store(Request $request) {

        $validate = $request->validate([

        ]);
        $current_user = Sentinel::getUser()->id;
        $quesions = VideoQuestion::where('video_id', $request->video_id)->get();
        //echo $quesions ; die();
        $check_survey = VideoReply::where('user_id', $current_user)->where('video_id', $request->video_id)->get();
        if(!$check_survey->isEmpty())
        {
            return Redirect::back()->withInput()->with('error', 'User have already left survey for this video');
        }
        try {

            foreach ($quesions as $question) {
                $answer = $request[$question->id];
                $result = new VideoReply();
                $result->user_id = $current_user;
                $result->video_id = $request->video_id;
                $result->question = $question->question;
                if($request->comment) {
                    $result->comment = $request->comment;
                }
                $result->answer = $answer;
                $result->save();

            }

            return view('thank')->with("success", "The Survey was reported successfully");
        }
        catch (Exception $e) {

            return Redirect::back()->withInput()->with('error', 'Please try survey again for connection');

        }

    }

    public function thank() {
        return view('thank');
    }

    public function export($id) {

        echo $id;die();
    }
}
