@extends('layouts.app')
@section('title')
  Update Courier
@endsection
@section('content')
  <form action="/couriers/{{$courier->id}}" method="post">
    {{ csrf_field() }}
    @method('put')
    <div class="form-group row justify-content-center">
      <label for="staticId" class="col-sm-2">Courier Id</label>
      <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" value={{$courier->id}}>
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="name" class="col-sm-2">Courier Name</label>
      <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="{{$courier->name}}">
      </div>
    </div>
    <div class="form-group row justify-content-center">
      <label for="shippingCost" class="col-sm-2">Courier Shipping Cost</label>
      <div class="col-sm-10">
        <input type="number" name="shippingCost" class="form-control" placeholder="{{$courier->shippingCost}}">
      </div>
    </div>
    <div class="row justify-content-center">
      <input type="submit" class="btn btn-primary text-white">
    </div>
  </form>
@endsection