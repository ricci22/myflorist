@extends('layouts.app')
@section('title')
  Flower Details
@endsection
@section('callToActionBtn')
  <div class="row justify-content-center">
    <a class="btn btn-primary text-white m-auto" href="/" role="button">More Flowers...</a>
  </div>
@endsection
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="card col-4">
        <div class="card-body">
          <img class="card-img" width="300" height="300" src="/storage/cover_image/{{$flower->cover_image}}" alt="Card image cap">
        </div>
      </div>
      <div class="card col-8">
        <div class="row float-left ml-lg-2 mt-lg-2">
          <h4 class="card-title text-center">{{$flower->name}}</h4>
        </div>
        <hr class="mt-lg-n1">
        <div class="row float-left ml-lg-2" style="height: 17rem">
          <p>{{$flower->desc}}</p>
        </div>
        <form action="/carts/{{$flower->id}}" method="post">
          @csrf
          @method('put')
          <div class="row">
            <div class="form-group col-3">
              <label for="qty">Stock : {{$flower->stock}}</label>
              <input type="number" name="qty" class="form-control" placeholder="0">
            </div>
            <div class="col-6">
              <h3 class="float-right text-primary">Rp. {{$flower->price}}</h3>
            </div>
            <div class="col-auto float-right">
              <input type="submit" class="btn btn-primary text-white m-auto" value="Add to Cart">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection