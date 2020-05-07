@extends('layouts.app')

@section('content')
<div class="col-md-8 col-md-offset-2 ">
  <h2>{{$video->title}}</h2>
  <hr>

  <div class="col-md-8">
      <!--video-->
      <video controls src="{{route ('fileVideo',['filename' => $video->video_path])}}" autoplay>

      </video>
      <!--Descripción-->
      Subido por el usuario {{$video->user->name.' '.$video->user->surname}} el día {{\FormatTime::LongTimeFilter($video->created_at)}}

      <!--comentarios-->
  </div>
</div>
@endsection
