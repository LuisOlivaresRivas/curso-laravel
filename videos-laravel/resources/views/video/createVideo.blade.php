@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12"><h2>Crear un nuevo video</h2><hr></div>
  </div>
  <div class="row">
    <form action="" method="post" enctype="multipart/form-data" class="col-lg-7">
      <div class="form-group">
        <label for="title">Titulo</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="form-group">
        <label for="description">Descripción</label>
        <textarea class="form-control" id="description" name="description"></textarea>
      </div>
      <div class="form-group">
        <label for="image">Miniatura</label>
        <input type="file" class="form-control" id="image" name="image">
      </div>
      <div class="form-group">
        <label for="video">Video</label>
        <input type="file" class="form-control" id="video" name="video">
      </div>
    </form>
  </div>
</div>

@endsection
