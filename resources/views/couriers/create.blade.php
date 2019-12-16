@extends('layouts.app')
@section('title')
  Insert Couriers
@endsection
@section('content')
  <form action="/couriers" method="post">
    {{ csrf_field() }}
    @method('post')
    <div class="form-group row justify-content-center">
      <label for="name" class="col-sm-2">Courier Name</label>
      <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Name">
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="shippingCost" class="col-sm-2">Courier Shipping Cost</label>
      <div class="col-sm-10">
        <input type="number" name="shippingCost" class="form-control" placeholder="0">
      </div>
    </div>
    <div class="row justify-content-center">
      <input type="submit" class="btn btn-primary text-white">
    </div>
  </form>
@endsection