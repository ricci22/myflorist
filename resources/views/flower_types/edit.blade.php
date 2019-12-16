@extends('layouts.app')
@section('title')
  Update Flower Type
@endsection
@section('content')
  <form action="/flower_types/{{$flowerType->id}}" method="post">
    {{ csrf_field() }}
    @method('put')
    <div class="form-group row justify-content-center">
      <label for="staticId" class="col-sm-2">Flower Type Id</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" value={{$flowerType->id}}>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="name" class="col-sm-2">Flower Type Name</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="name" placeholder="{{$flowerType->name}}">
      </div>
    </div>
    <div class="row justify-content-center">
      <input type="submit" class="btn btn-primary text-white">
    </div>
  </form>
@endsection