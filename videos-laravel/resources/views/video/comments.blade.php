<div class="content">

  @if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
  @endif
  <div class="card" id="nuevo-comentario">
    <div class="card-body">
      <h4 class="card-title">Comentarios</h4>
      @if(Auth::check())
        <form action="{{url('/comment')}}" method="post">
          {!! csrf_field() !!}
          <input type="hidden" name="video_id" value="{{$video->id}}" required>
          <textarea placeholder="Escribe tu comentario aquí" class="pb-cmnt-textarea" name="body" required></textarea>
          <input type="submit" class="btn btn-success" value="Comentar">
        </form>
      @endif
    </div>
  </div>
  @if(isset($video->comments))
    @foreach($video->comments as $comment)
    <div class="card separacion"><div class="card-body"></div></div>
    <div class="card comentario-listado">
      <div class="card-header">
        {{$comment->user->name.' '.$comment->user->surname}}  {{\FormatTime::LongTimeFilter($comment->created_at)}}
      </div>
      <div class="card-body">
          {{$comment->body}}

      </div>
      <div class="card-footer">
         @if(Auth::user()->id == $comment->user_id || Auth::user()->id == $video->user_id)
          <a href="#modal-eliminar{{$comment->id}}" role="button" class="btn btn-danger float-right" data-toggle="modal">Eliminar</a>
          <div class="modal fade" id="modal-eliminar{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>¿Seguro que quieres borrar este comentario?</p>
                <p class="text-primary"><small>{{$comment->body}}</small></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <a href="{{ url('/delete-comment/'.$comment->id) }}" type="button" class="btn btn-danger">Eliminar</a>
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
    @endforeach
  @endif
</div>
