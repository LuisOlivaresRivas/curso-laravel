@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card" id="video-reproductor" style="max-width:80%;">
    <div class="card-body">
      <h5 class="card-title">{{$video->title}}</h5>
      <video controls src="{{route ('fileVideo',['filename' => $video->video_path])}}" autoplay width="100%">
      </video>
      <p class="card-text">  Subido por el usuario {{$video->user->name.' '.$video->user->surname}}  {{\FormatTime::LongTimeFilter($video->created_at)}}</p>
    </div>
  </div>

@include('video.comments')
</div>
@endsection
