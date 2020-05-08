<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Video;
use App\Comment;

class VideoController extends Controller
{
    public function createVideo(){
      return view('video.createVideo');
    }

    public function saveVideo(Request $request){

      //Validar Formlario
      $validatedData = $this->validate($request,[
        'title' => 'required|min:5',
        'description' => 'required',
        'video' => 'mimes:mp4'
      ]);

      $video  = new Video();
      $user = \Auth::user();
      $video->user_id= $user->id;
      $video->title = $request->input('title');
      $video->description = $request->input('description');

      //Subida de la miniatura
      $image = $request->file('image');
      if ($image) {
        $image_path = time().$image->getClientOriginalName();
        \Storage::disk('images')->put($image_path, \File::get($image));
        $video->image = $image_path;
      }
      $video_file = $request->file('video');
      if ($video_file) {
        $video_path = time().$video_file->getClientOriginalName();
        \Storage::disk('videos')->put($video_path, \File::get($video_file));
        $video->video_path = $video_path;
      }
      //$video->video = $request->input('video');
      $video->save();

      return redirect()->route('home')->with(array(
        'message' => 'El video se ha subido correctamente!!'
      ));

    }

    public function getImage($filename){
      $file = Storage::disk('images')->get($filename);
      return new Response($file, 200);
    }

    public function getVideoDetail($video_id){
        $video = Video::find($video_id);
        return view('video.detail',array(
          'video' => $video
        ));
    }

    public function getVideo($filename){
      $file = Storage::disk('videos')->get($filename);
      return new Response($file, 200);
    }

    public function delete($video_id){
      $user = \Auth::user();
      $video = Video::find($video_id);
      $comments = Comment::where('video_id', $video_id)->get();

      if($user && $video->user_id == $user->id){
        //eliminar Comentarios
        if($comments && count($comments)>=1){
          foreach($comments as $comment){
            $comment->delete();
          }

        }
        //eliminar ficheros
        Storage::disk('images')->delete($video->image);
        Storage::disk('videos')->delete($video->video_path);

        $video->delete();

        $message = array('message' => 'Video eliminado corecctamente');
    }else{
      $message = array('message' => 'EL VIDEO NO SE HA ELIMINADO!!');
    }

    return redirect()->route('home')->with($message);
  }
}
