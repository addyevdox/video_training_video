<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;


class VideoController extends Controller
{
   public function index() {
       $videos = Video::all();

       return view('video.index', compact('videos'));
   }

   public function item($id) {

       $video = Video::where('id', $id)->first();

       return view('video.item', compact('video'));
   }

}
