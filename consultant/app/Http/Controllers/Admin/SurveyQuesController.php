<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VideoQuestion;
use App\Models\VideoAnswer;
use phpDocumentor\Reflection\DocBlock;
use Redirect;
class SurveyQuesController extends Controller
{
    //

    public function index() {

        $questions = VideoQuestion::all();
        return view('admin.question.default', compact('questions'));

    }


    public function getQuestion($id) {

        $questions = VideoQuestion::where('video_id',$id)->get();
        return view('admin.question.index', compact('questions','id'));
    }

    public function store(Request $request) {

        $validate = $request->validate([
            'question'=>'required'
        ]);
        $question = new VideoQuestion();
        $question->question = $request->question;
        $question->video_id = $request->video_id;

        $question_count = VideoQuestion::where('video_id', $request->video_id)->count();
        if($question_count < 5)
        {
            $question->save();
            return redirect('admin/question/'.$question->video_id)->with('success',trans('video/message.success.create'));
        }
        else{
            return Redirect::back()->withInput()->with('error', 'The count of Question is exceeded');
        }


    }

    public function delete($id) {

        $video = VideoQuestion::where('id',$id)->first();
        $result = VideoQuestion::where('id', $id)->delete();
        $result1 = VideoAnswer::where('question_id', $id)->delete();
        if($result) {
            return redirect('admin/question/'.$video->video_id)->with('success','The question is deleted successfully');
        }
    }

    public function edit($id) {
        $question = VideoQuestion::where('id', $id)->get();

        echo json_encode($question);
    }

    public function update(Request $request) {
        $validae = $request->validate([
           'question'=>'required'
        ]);

        //echo $request->id; die();
        $question = VideoQuestion::where('id', $request->id)->update(['question' => $request->question]);
        if($question) {
            return redirect('admin/question/'.$request->video_id)->with('success','The question is updated successfully');
        }


    }
}
