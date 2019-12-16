@extends('layouts.app')
@section('title')
  Insert Flowers
@endsection
@section('content')
  <form action="/flowers" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    @method('post')
    <div class="form-group row justify-content-center">
      <label for="name" class="col-sm-2">Flower Name</label>
      <div class="col-sm-10">
        <input type="name" name="name" class="form-control" placeholder="Name">
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="price" class="col-sm-2">Flower Price</label>
      <div class="col-sm-10">
        <input type="number" name="price" class="form-control" placeholder="0">
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="stock" class="col-sm-2">Flower Stock</label>
      <div class="col-sm-10">
        <input type="number" name="stock" class="form-control" placeholder="0">
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="type" class="col-form-label col-sm-2">Flower Type Names</label>
      <div class="col-sm-10">
        <select name="type" class="form-control">
          @foreach($flowerTypeNames as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="desc" class="col-sm-2">Flower Description</label>
      <div class="col-sm-10">
        <textarea name="desc" class="form-control" placeholder="Describe the Flower ....."></textarea>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="cover_image" class="col-form-label col-sm-2">Flower Cover Image</label>
      <div class="col-sm-10">
        <input type="file" name="cover_image">
      </div>
    </div>
    <div class="row justify-content-center">
      <input type="submit" class="btn btn-primary text-white">
    </div>
  </form>
@endsection