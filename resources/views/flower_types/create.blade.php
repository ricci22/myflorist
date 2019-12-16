@extends('layouts.app')
@section('title')
  Insert Flower Type
@endsection
@section('content')
  <form action="/flower_types" method="post">
    {{ csrf_field() }}
    @method('post')
    <div class="form-group row justify-content-center">
      <label for="name" class="col-sm-2">Flower Type Name</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" id="name" name="name" placeholder="Name">
      </div>
    </div>
    <div class="row justify-content-center">
      <input type="submit" class="btn btn-primary text-white">
    </div>
  </form>
@endsection