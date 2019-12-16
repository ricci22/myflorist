@extends('layouts.app')
@section('callToActionBtn')
  <div class="row justify-content-center">
    <a class="btn btn-primary text-white m-auto" href="/couriers/create" role="button">Insert Courier</a>
  </div>
@endsection
@section('title')
  Manage Couriers
@endsection
@section('content')
  <div class="justify-content-center">
    <form class="form-inline" action="/couriers/search" method="post">
      @csrf
      <input class="form-control col-lg-5 ml-auto mr-2" type="text" name="search" placeholder="I want to find...">
      <button type="submit" class="btn btn-primary text-white mr-auto ml-2">Search</button>
    </form>
  </div>
  @if(count($couriers) > 0)
    <div class="container">
      <div class="row justify-content-center">
        @foreach($couriers as $courier)
          <div class="card m-2" style="width: 12.5rem;">
            <div class="card-body">
              <h5 class="card-title text-center">ID : {{$courier->id}}</h5>
              <h4 class="card-title text-center">{{$courier->name}}</h4>
              <h6 class="card-title text-center">Cost: Rp {{$courier->shippingCost}}</h6>
              <div class="row justify-content-center">
                <a href="/couriers/{{$courier->id}}/edit" class="btn btn-dark ml-sm-2 mr-auto">Update</a>
                <form action="/couriers/{{$courier->id}}" method="post">
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
    <h3 class="row justify-content-center m-lg-5 text-danger">No Couriers Found!</h3>
  @endif
  <div class="row justify-content-center">
    @if(count($couriers) > 0)
      {{$couriers->links()}}
    @endif
  </div>
@endsection