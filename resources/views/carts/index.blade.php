@extends('layouts.app')
@section('title')
  Cart
@endsection
@section('callToActionBtn')
  <div class="row justify-content-center">
    <a class="btn btn-primary text-white m-auto" href="/" role="button">More Flowers...</a>
  </div>
@endsection
@section('content')
  @if($cartExist)
    @if(count($cartDetails) > 0)
      <div class="container mt-3">
        <div class="row justify-content-center">

          <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
              <th scope="col">Picture</th>
              <th scope="col">Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
              <th scope="col">Total</th>
              <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartDetails as $cartDetail)
              <tr>
                <td width="20%"><img class="card-img" height="100px" src="/storage/cover_image/{{$cartDetail->flower->cover_image}}" alt="Image Not Loaded"></td>
                <td>{{$cartDetail->flower->name}}</td>
                <td>{{$cartDetail->qty}}</td>
                <td>{{$cartDetail->flower->price}}</td>
                <td>{{$cartDetail->total}}</td>
                <td width="15%">
                  <div class="row">
                    <form action="/carts/{{$cartDetail->id}}" method="post">
                      @csrf
                      @method('delete')
                      <input type="submit" class="btn btn-secondary" value="Remove">
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <form action="/carts" method="post">
            @csrf
            <div class="form-group row">
              <label for="courier" class="col-form-label col-auto"></label>
              <div class="col-auto">
                <select id="courierOption"  onchange="onChangeSelectedCourier()" name="courier" class="form-control courierOption">
                  <option disabled selected>Select your Courier</option>
                  @foreach($couriers as $courier)
                    <option value="{{$courier->id}}">{{$courier->name}} :Shipping Cost: Rp {{$courier->shippingCost}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row justify-content-center">
              <h7>*Price below not including the shipping cost</h7>
              <h6 id="courierPrice"> </h6>
            </div>

            <div class="row justify-content-center">
              <label for="grandTotal" hidden>
                <input id="grandTotal" type="text" value="{{$cartsTotal}}">
              </label>
              <h5 id="grandTotalPlusCourier">Grand Total : Rp. {{$cartsTotal}}</h5>
            </div>

            <div class="row justify-content-center">
              <input type="submit" class="btn btn-dark text-white" value="Checkout">
            </div>
          </form>

        </div>
      </div>
    @else
      <h3 class="row justify-content-center m-lg-5 text-danger">Your Cart is currently Empty!</h3>
    @endif
  @else
    <h3 class="row justify-content-center m-lg-5 text-danger">Your Cart is currently Empty!</h3>
  @endif
@endsection

<script>
  // function onChangeSelectedCourier() {
  //   var c = document.getElementsByClassName("courierOption").id;
  //   var t = document.getElementById("grandTotal").value;
  //   var grandTotal = parseInt(c) + parseInt(t);
  //   document.getElementById("courierPrice").innerHTML = c;
  //   document.getElementById("grandTotalPlusCourier").innerHTML = "Grand Total : Rp " + grandTotal;
  // }
</script>