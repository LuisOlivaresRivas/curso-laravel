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
        @foreach($videos as $video)

        <div class="card" style="width:50rem;">

          <div class="card-body pull-right">
            <div class="row">
              <div class="col-md-3">
                @if(Storage::disk('images')->has($video->image))
                  <img class="card-img-top" src="{{url ('/miniatura/'.$video->image)}}"  style="width: 7rem;">
                @endif
              </div>
              <div class="col-md-6">
            <h4 class="card-title"><a href="{{ route('detailVideo',['video_id' => $video->id]) }}" >{{ $video->title? $video->title : 'titulo no disponibe' }}</h4></a>
            <p class="card-text">{{$video->user->name.' '.$video->user->surname}}</p>
            <a href="{{ route('detailVideo',['video_id' => $video->id]) }}" class="btn btn-success">Ver</a>
            @if(Auth::check() && Auth::user()->id == $video->user->id)
              <a href="" class="btn btn-primary">Editar</a>
              <a href="#modal-eliminar{{$video->id}}" role="button" data-toggle="modal" class="btn btn-danger">Eliminar</a>
              <div class="modal fade" id="modal-eliminar{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>¿Seguro que quieres borrar este video?</p>
                    <p class="text-primary"><small>{{$video->title}}</small></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <a href="{{ url('/delete-video/'.$video->id) }}" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>
          </div>
          </div>
        </div>
        <br>
          @endforeach
        </div>
      </div>
      <div class="row">
      <div class="col-md-12">{{$videos->links()}}</div>
    </div>
    </div>

@endsection
