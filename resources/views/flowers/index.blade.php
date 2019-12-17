@extends('layouts.app')
@section('callToActionBtn')
  <div class="row justify-content-center">
    <a class="btn btn-primary text-white m-auto" href="/flowers/create" role="button">Insert Flower</a>
  </div>
@endsection
@section('title')
  Manage Flowers
@endsection
@section('content')
  <div class="justify-content-center">
    <form class="form-inline" action="/flowers/search" method="post">
      @csrf
      <input class="form-control col-lg-5 ml-auto mr-2" type="text" name="search" placeholder="I want to find...">
      <button type="submit" class="btn btn-primary text-white mr-auto ml-2">Search</button>
    </form>
  </div>
  @if(count($flowers) > 0)
    <div class="container">
      <div class="row justify-content-center">
        @foreach($flowers as $flower)
          <a href="#" class="text-decoration-none !important text-dark">
          <div class="card m-2" style="width: 15rem;height: 20rem">
            <div class="card-body">
              <h4 class="card-title text-center">{{$flower->name}}</h4>
              <img class="card-img-top" width="120" height="120" src="/storage/cover_image/{{$flower->cover_image}}" alt="Card image cap">
              <div class="row card-body m-auto" style="height: 6rem">
                <p class="card-text">{{(substr($flower->desc, 0, 40)."...")}}</p>
              </div>
              <div>
                <a href="/flowers/{{$flower->id}}/edit" class="btn btn-dark col-auto m-auto float-left">Update</a>
                <form action="/flowers/{{$flower->id}}" method="post">
                  {{ csrf_field() }}
                  @method('delete')
                  <input type="submit" class="btn btn-secondary col-auto m-auto float-right" value="Delete">
                </form>
              </div>
            </div>
          </div>
          </a>
        @endforeach
      </div>
    </div>
  @else
    <h3 class="row justify-content-center m-lg-5 text-danger">No Flowers Found!</h3>
  @endif
  <div class="row justify-content-center">
    @if(count($flowers) > 0)
      {{$flowers->links()}}
    @endif
  </div>
@endsection