<h4>Comentarios</h4>
@if(session('message'))
  <div class="alert alert-success">
      {{session('message')}}
  </div>
@endif
@if(Auth::check())
<form class="col-md-4" action="{{url('/comment')}}" method="post">
  {!! csrf_field() !!}
  <input type="hidden" name="video_id" value="{{$video->id}}" required>
  <p>
      <textarea name="body" class="form-control" required></textarea>
  </p>
  <input type="submit" class="btn btn-success" value="Comentar">
</form>
@endif

@if(isset($video->comments))
  @foreach($video->comments as $comment)
    {{$comment->user->name.' '.$comment->user->surname}} hace {{\FormatTime::LongTimeFilter($comment->created_at)}}
    {{$comment->body}}
  @endforeach
@endif
