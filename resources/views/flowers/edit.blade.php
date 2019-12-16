@extends('layouts.app')
@section('title')
  Update Flowers
@endsection
@section('content')
  <form action="/flowers/{{$flower->id}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    @method('put')
  <div class="form-group row justify-content-center">
    <label for="name" class="col-sm-2">Flower Name</label>
    <div class="col-sm-10">
      <input type="name" name="name" class="form-control" placeholder="{{$flower->name}}">
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="price" class="col-sm-2">Flower Price</label>
    <div class="col-sm-10">
      <input type="number" name="price" class="form-control" placeholder="{{$flower->price}}">
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="stock" class="col-sm-2">Flower Stock</label>
    <div class="col-sm-10">
      <input type="number" name="stock" class="form-control" placeholder="{{$flower->stock}}">
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="type" class="col-form-label col-sm-2">Flower Type Names</label>
    <div class="col-sm-10">
      <select name="type" class="form-control">
        @foreach($flowerTypeNames as $key => $value)
          @if ($flower->flowerTypes_id == $key)
            <option value="{{$key}}" selected>{{$value}}</option>
          @else
            <option value="{{$key}}">{{$value}}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label for="desc" class="col-sm-2">Flower Description</label>
    <div class="col-sm-10">
      <textarea name="desc" class="form-control" placeholder="{{$flower->desc}}"></textarea>
    </div>
  </div>
  <div class="form-group row justify-content-center">
    <label class="col-form-label col-sm-2">Flower Cover Image</label>
    <div class="col-sm-10">
      <input type="file" name="cover_image">
    </div>
  </div>
  <div class="row justify-content-center">
    <input type="submit" class="btn btn-primary text-white">
  </div>
  </form>
@endsection