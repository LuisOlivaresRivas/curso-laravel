@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="container">
        @if(session('message'))
          <div class="aler alert-success">
            {{session('message')}}
          </div>
        @endif
        <div id="videos-list">
          @foreach($videos as $video)
            <div class="video-item col-md-10 pull-left jumbotron">
              <div class="panel-body">
                @if(Storage::disk('images')->has($video->image))
                  <div class="video-image-thumb col-md-4 pull-left">
                    <div class="col-md-6 col-md-offset">
                      <img src="{{url ('/miniatura/'.$video->image)}}" />
                    </div>
                  </div>
                @endif
              <div class="data">
                <h4>{{ $video->title? $video->title : 'titulo no disponibe' }}</h4>
                <p>{{$video->user->name.' '.$video->user->surname}}</p>
              </div>
              <a href="" class="btn btn-success">Ver</a>
              @if(Auth::check() && Auth::user()->id == $video->user->id)
                <a href="" class="btn btn-primary">Editar</a>
                <a href="" class="btn btn-danger">Eliminar</a>
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>
      {{$videos->links()}}
    </div>
</div>
@endsection
