@extends('layouts.app')
@section('callToActionBtn')
  <div class="row justify-content-center">
    <a class="btn btn-primary text-white m-auto" href="/flower_types/create" role="button">Insert Flower Type</a>
  </div>
@endsection
@section('title')
  Manage Flower Types
@endsection
@section('content')
  <div class="justify-content-center">
    <form class="form-inline" action="/flower_types/search" method="post">
      @csrf
      <input class="form-control col-lg-5 ml-auto mr-2" type="text" name="search" placeholder="I want to find...">
      <button type="submit" class="btn btn-primary text-white mr-auto ml-2">Search</button>
    </form>
  </div>
  @if(count($flowerTypes) > 0)
    <div class="container">
      <div class="row justify-content-center">
        @foreach($flowerTypes as $flowerType)
          <div class="card m-2" style="width: 12.5rem;">
            <div class="card-body">
              <h5 class="card-title text-center">{{$flowerType->name}}</h5>
              <div class="row justify-content-center">
                <a href="/flower_types/{{$flowerType->id}}/edit" class="btn btn-dark ml-sm-2 mr-auto">Update</a>
                <form action="/flower_types/{{$flowerType->id}}" method="post">
                  {{ csrf_field() }}
                  @method('delete')
                  <input type="submit" class="btn btn-secondary mr-sm-2 ml-auto" value="Delete">
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @else
    <h3 class="row justify-content-center m-lg-5 text-danger">No Flower Types Found!</h3>
  @endif
  <div class="row justify-content-center">
    @if(count($flowerTypes) > 0)
      {{$flowerTypes->links()}}
    @endif
  </div>
@endsection