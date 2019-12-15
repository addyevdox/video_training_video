<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Models\VideoQuestion;
use App\Models\VideoAnswer;
use App\Models\VideoReply;
use App\Models\Training;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use PhpParser\Node\Expr\Array_;
use Sentinel;
use Redirect;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use PHPExcel_Worksheet_Drawing;


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

       $surveyQuestions = VideoQuestion::select('id', 'question')->where('video_id',$id)->get();

       $date = date('d/m/Y');
       $time = date('H:i A');
       $cellData = [
           ['', '', '', 'Training Report', '', '', '', '', '', '', '' ],
           ['', '', '', '(Video Name)', '', '', '', 'Report Time', $date, '', ''],
           ['', '', '', '', '', '', '', 'Report Date', $time, '', ''],
           ['ID number', 'Full Name', 'Training complete', 'Survey Complete', '1st survey question', '2nd survey question', '3rd survey question', '4th survey question', '5th survey question', 'Survey comment', 'Date of completion']
       ];

       $cnt = $surveyQuestions->count();


       for ($i = 0; $i < $cnt; $i ++) $cellData[3][$i + 4] = $surveyQuestions[$i]->question;

       $users = User::select('id','email', 'first_name', 'last_name')->get();
       $cellData[1][3] = Video::select('title')->where('id', $id)->get()[0]->title;

       foreach($users as $user) {


           $video = VideoReply::where('user_id', $user->id)->where("video_id", $id)->get();

           $training_complete = Training::where('user_id', $user->id)->where('video_id', $id)->get();

           $statusVal = "No";
           $completed = "";

           if(!$training_complete->isEmpty()) $statusVal = $training_complete[0]->status;

           if ($video->count()) {

               $questions = DB::table('survey_replys')
                   ->select('survey_replys.question','survey_replys.answer', 'survey_replys.comment', 'survey_replys.created_at')
                   ->join('video_survey_questions', 'video_survey_questions.question', '=', 'survey_replys.question')
                   ->where('survey_replys.user_id', $user->id)
                   ->get();

               $completed = count($questions) > 0 ? "Yes" : "No";

           }

           else {
               $questions = array();
           }

           $temp = array(

               $user->email,
               $user->first_name." ".$user->last_name,
               $statusVal,
               $completed,
               "", "", "", "", "", "", ""
           );

           foreach ($questions as $item) {

               for ($i = 0; $i < $cnt; $i ++) {
                   if ($item->question == $surveyQuestions[$i]->question) {
                       $temp[$i + 4] = $item->answer;
                       $s = $item->created_at;
                       $dt = new DateTime($s);
                       $temp[10] = $dt->format('d/m/Y');
                       $temp[9] = $item->comment;

                   }

               }
           }


           array_push($cellData, $temp);


       }



       try {

           return Excel::create('excel report', function ($excel) use ($cellData) {
               $excel->sheet('sheet1', function ($sheet) use ($cellData){

                   $sheet->rows($cellData);
                   $sheet->setWidth(array(
                       'A' => 20,
                       'B' => 20,
                       'C' => 20,
                       'D' => 20,
                       'E' => 20,
                       'F' => 20,
                       'G' => 20,
                       'H' => 20,
                       'I' => 20,
                       'J' => 20,
                       'K' => 20,
                   ));

                   $sheet->mergeCells('A1:B3');
                   $sheet->mergeCells('D1:F1');
                   $sheet->mergeCells('D2:F3');


                   $objDrawing = new PHPExcel_Worksheet_Drawing();
                   $objDrawing->setPath(public_path('img/logo2.png')); //your image path
                   $objDrawing->setCoordinates('A1');
                   $objDrawing->setWorksheet($sheet);

                   $sheet->cell('A1', function($cell){
                       $cell->setValignment('center');
                       $cell->setAlignment('center');
                   });

                   $sheet->cell('D1', function($cell){
                       $cell->setValignment('center');
                       $cell->setAlignment('center');
                   });

                   $sheet->cell('D2', function($cell){
                       $cell->setValignment('center');
                       $cell->setAlignment('center');
                   });
               });
           })->download('xlsx');
       }

       catch (Exception $e) {
           die();
       }


       
    }
}
