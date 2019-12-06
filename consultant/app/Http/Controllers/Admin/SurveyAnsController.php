<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VideoAnswer;

class SurveyAnsController extends Controller
{
    //

    public function index() {
        $answers = VideoAnswer::all();
        // Show the page
        return view('admin.answer.default', compact('answers'));
    }

    public function getAnswer($id) {

        $answers = VideoAnswer::where('question_id',$id)->get();
        return view('admin.answer.index', compact('answers','id'));
    }

    public function store(Request $request) {

        $validate = $request->validate([
            'answer'=>'required'
        ]);
        $answer =  new VideoAnswer();
        $answer->answer = $request->answer;
        $answer->question_id = $request->question_id;

        $answer_count = VideoAnswer::where('question_id', $request->question_id)->count();
        if($answer_count < 5)
        {
            $answer->save();
            return redirect('admin/answer/'.$answer->question_id)->with('success',trans('video/message.success.create'));
        }
        else{
            return Redirect::back()->withInput()->with('error', 'The count of Answer is exceeded');
        }


    }

    public function delete($id) {

        $video = VideoAnswer::where('id',$id)->first();
        $result = VideoAnswer::where('id', $id)->delete();
        if($result) {
            return redirect('admin/answer/'.$video->question_id)->with('success','The Answer is deleted successfully');
        }
    }

    public function edit($id) {
        $answer = VideoAnswer::where('id', $id)->get();

        echo json_encode($answer);
    }

    public function update(Request $request) {
        $validae = $request->validate([
            'answer'=>'required'
        ]);

        $answer = VideoAnswer::where('id', $request->id)->update(['answer' => $request->answer]);
        if($answer) {
            return redirect('admin/answer/'.$request->question_id)->with('success','The Answer is updated successfully');
        }


    }
}
