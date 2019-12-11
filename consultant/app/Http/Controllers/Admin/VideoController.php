<?php

namespace App\Http\Controllers\Admin;

use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoQuestion;
use App\Models\VideoReply;
use App\Models\VideoComment;
use Mockery\Exception;
use Sentinel;
use DOMDocument;

class VideoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Grab all the blogs
        $videos = Video::all();
        // Show the page
        return view('admin.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'video' => 'required'
        ]);


        $message=$request->get('description');
//        echo $message;die();
        $dom = new DOMDocument();
        $dom->loadHtml($message, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $video = new Video($request->except('files','video', 'description'));
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $extension = $file->extension() ?: 'mp4';
            $movie = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . '/uploads/videos/';
            $file->move($destinationPath, $movie);
            $video->video = $movie;

        }

        $video->description = $message;
        $video->user_id = Sentinel::getUser()->id;


        $video->save();


        if ($video->id) {
            return redirect('admin/video')->with('success', trans('video/message.success.create'));
        } else {
            return Redirect::route('admin/video')->withInput()->with('error', trans('video/message.error.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('admin/video/edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {

        $validatedData = $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'video' => 'required'
        ]);

        $message = $request->get('description');
        $dom = new DOMDocument();
        $dom->loadHTML($message,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);


        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $extension = $file->extension() ?: 'mp4';
            $movie = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . '/uploads/videos/';
            $file->move($destinationPath, $movie);
            $video->video = $movie;

        }

        $video->description = htmlspecialchars($message);

        if($video->update($request->except('files', 'description','video'))) {
            return redirect('admin/video')->with('success',trans('video/message.success.create'));
        }

        else{
            return Redirect::route('admin/video')->withInput()->with('error', trans('video/message.error.create'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *
     *
     *
     */


    public function getModalDelete(Video $video)
    {
        $model = 'video';
        $confirm_route = $error = null;
        try {
            $confirm_route = route('admin.video.delete', ['id' => $video->id]);
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        } catch (GroupNotFoundException $e) {

            $error = trans('video/message.error.destroy', compact('id'));
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
    }

    public function destroy(Video $video)
    {

        if ($video->delete() AND $this->file_delete($video->video)) {
            return redirect('admin/video')->with('success', trans('video/message.success.delete'));
        } else {
            return Redirect::route('admin/video')->withInput()->with('error', trans('video/message.error.delete'));
        }
        //
    }

    public function file_delete($file_path) {

        try{

            $result = unlink(public_path()."/uploads/videos/".$file_path);
        }
        catch (Exception $e) {

            return false;
        }

            return true;
    }
}

