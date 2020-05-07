<div class="content">

  @if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
  @endif
  <div class="card" id="nuevo-comentario" style="max-width:80%;">
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
      <div class="row"><div class="col-md-12"><hr></div></div>
      <div class="row">
        @if(isset($video->comments))
          @foreach($video->comments as $comment)
          <div class="col-md-6">
            {{$comment->user->name.' '.$comment->user->surname}} hace {{\FormatTime::LongTimeFilter($comment->created_at)}}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            {{$comment->body}}
          </div>
          </div>
          @endforeach
        @endif

    </div>
  </div>
</div>
