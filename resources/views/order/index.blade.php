@extends('layouts.app')
@section('title')
  Order History
@endsection
@section('content')
  @if(count($transactions) > 0)
    <div class="container mt-3">
      @foreach($transactions as $transaction)
        <table class="table mb-3">
          <tr><th>Transaction ID : {{$transaction->id}}<th><tr>
          <tr><th>Transaction Date : {{$transaction->created_at}}<th></tr>
          <tr><th>Member Name : {{$transaction->uname}}<th></tr>
          <tr><th>Courier : {{$transaction->cname}}<th></tr>
        </table>
        <table class="table table-striped">
          <thead class="thead-dark">
          <tr>
            <th scope="col">Picture</th>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Total</th>
          </tr>
          </thead>
          <tbody>
          @foreach($transactionDetails->where('transaction_id', $transaction->id) as $transactionDetail)
            <tr>
              <td width="20%"><img class="card-img" height="100px" src="/storage/cover_image/{{$transactionDetail->fimage}}" alt="Image Not Loaded"></td>
              <td>{{$transactionDetail->fname}}</td>
              <td>{{$transactionDetail->qty}}</td>
              <td>Rp {{$transactionDetail->flower->price}}</td>
              <td>Rp {{$transactionDetail->total}}</td>
            </tr>
          @endforeach
          </tbody>
          <tr class="table-light">
            <th></th>
            <th></th>
            <th></th>
            <th>ShippingCost</th>
            <th>Rp {{$transaction->courier->shippingCost}}</th>
          </tr>
          <tr class="table-light">
            <th></th>
            <th></th>
            <th></th>
            <th>Grand Total</th>
            <th>Rp {{$transaction->total}}</th>
          </tr>
        </table>
      @endforeach
    </div>
  @else
    <h3 class="row justify-content-center m-lg-5 text-danger">Currrently You haven't Order anything yet!</h3>
  @endif
@endsection