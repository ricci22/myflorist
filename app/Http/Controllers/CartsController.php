<?php

namespace App\Http\Controllers;

use App\TransactionDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Courier;
use App\Transaction;
use App\Cart;
use App\CartDetail;
use App\Flower;

class CartsController extends Controller
{
    /**Cart Page
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // returning cart data according to the user Cart
      $userID = Auth::id();

      // validate if cart exist
      $cart = Cart::where('user_id', $userID)->first();
      if (!$cart) {
        $cartExist = false;
        return view('carts.index')->with(compact('cartExist'));
      }
      else {
        $cartExist = true;
      }

      $cartID = $cart->id;
      $cartDetails = CartDetail::all()->where('cart_id', $cartID);
      $cartsTotal = $cartDetails->sum('total');
      $flowers = Flower::All();
      $couriers= Courier::All();
      return view('carts.index')
        ->with(compact('cartDetails', 'flowers', 'cartsTotal', 'couriers', 'cartExist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**Cart Checkout
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (Auth::check()){
        if (is_null($request->input('courier'))) {
          return redirect('/carts')->with('error', 'You need to select the Courier');
        }
        else {
          // query the User cart
          $userID = Auth::id();
          $cart = Cart::where('user_id', $userID)->first();
          $cartID = $cart->id;

          $transaction = new Transaction();
          $transaction->user_id = Auth::id();
          $transaction->courier_id = $request->input('courier');

          // getting the courier name
          $courierName = Courier::find($transaction->courier_id)->name;
          $transaction->cname = $courierName;

          // getting the user name
          $userName = User::find($transaction->user_id)->name;
          $transaction->uname = $userName;

          // calculate the grand total to store
          $cartDetails = CartDetail::all()->where('cart_id', $cartID);
          $cartTotal = $cartDetails->sum('total');
          $courierPrice = Courier::find($transaction->courier_id)->shippingCost;
          $transaction->total = $cartTotal + $courierPrice;

          // save data into transactions table
          $transaction->save();

          // process each row of cartDetails table
          foreach ($cartDetails as $cartDetail) {
            // insert data into transaction_details table
            $transactionDetails = new TransactionDetails();
            $transactionDetails->transaction_id = $transaction->id;
            $transactionDetails->flower_id = $cartDetail->flower_id;
            $transactionDetails->qty = $cartDetail->qty;
            $transactionDetails->total = $cartDetail->total;
            $transactionDetails->fname = Flower::find($transactionDetails->flower_id)->name;
            $transactionDetails->fimage = Flower::find($transactionDetails->flower_id)->cover_image;
            $transactionDetails->save();

            // Update the qty on flowers table
            $flower = Flower::find($transactionDetails->flower_id);
            $flower->stock -= $transactionDetails->qty;
            $flower->save();

            // Delete the CartDetail data
            $cartDetail->delete();
          }
          $cart->delete();
          return redirect('order')->with('success', 'Your Order has been processed, Thank You for Shopping!');
        }
      }
      else {
        return view('auth.login')->with('message', 'You need to be logged in first');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**Order button to increase the qty of order
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // validate user is logged in
      if(!Auth::check()) {
        return view('auth.login')->with('error', 'You need to be logged in first');
      }

      // check if there is already a cart relate to the user
      $userID = Auth::id();
      $cartExist = Cart::where('user_id', $userID)->first();
      if (is_null($cartExist)) {
        $cart = new Cart();
        $cart->user_id = $userID;
        $cart->save();
      }

      // Saving data CartDetail according to the cart_id
      $cart = Cart::where('user_id', $userID)->first();
      $cartID = $cart->id;
      $flowerStock = Flower::find($id)->stock;
      $data = CartDetail::where('cart_id', $cartID)->where('flower_id', $id)->first();
      if(is_null($data)) {
        $cartDetail = new CartDetail();
        // adding the cart id into new cart
        $cartDetail->cart_id = $cartID;
        $cartDetail->qty = 1;
        // validate the qty Ordered must not exceed the flower Stock
        if ($cartDetail->qty > $flowerStock) {
          return redirect('/')->with('error', 'Your order exceed the flower stock limit, Check your Cart');
        }
        $cartDetail->flower_id = $id;
        $cartDetail->total = Flower::find($id)->price;
        $cartDetail->save();
      }
      else {
        $cartDetail = $data;
        $cartDetail->qty += 1;
        // validate the qty Ordered must not exceed the flower Stock
        if ($cartDetail->qty > $flowerStock) {
          return redirect('/')->with('error', 'Your order exceed the flower stock limit, Check your Cart');
        }
        $cartDetail->total = Flower::find($id)->price * $cartDetail->qty;
        $cartDetail->save();
      }

      return redirect('/')->with('success', 'Adding your Order to your Cart');
    }

    /**Add to Cart button to increase/add qty to order
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // validate if user is logged in
      if(!Auth::check()) {
        return view('auth.login')->with('error', 'You need to be logged in first');
      }

      // validate if user entering the amount of qty
      $qty = $request->input('qty');
      if (is_null($qty)) {
        return redirect ('/flowers/'.$id)->with('error', 'You need to enter the amount to add to cart');
      }

      // check if there is already a cart relate to the user
      $userID = Auth::id();
      $cartExist = Cart::where('user_id', $userID)->first();
      if (is_null($cartExist)) {
        $cart = new Cart();
        $cart->user_id = $userID;
        $cart->save();
      }

      // Saving data CartDetail according to the cart_id
      $cart = Cart::where('user_id', $userID)->first();
      $cartID = $cart->id;
      $flowerStock = Flower::find($id)->stock;
      $qtyInput = $request->input('qty');
      $data = CartDetail::where('cart_id', $cartID)->where('flower_Id', $id)->first();

      if(is_null($data)) {
        $cartDetail = new CartDetail();
        $cartDetail->cart_id = $cartID;
        $cartDetail->qty = $qtyInput;
        // validate the qty Ordered must not exceed the flower Stock
        if ($cartDetail->qty > $flowerStock) {
          return redirect('/flowers/'.$id)->with('error', 'Your order exceed the flower stock limit, Check your Cart');
        }
        $cartDetail->flower_id = $id;
        $cartDetail->total = Flower::find($id)->price * $cartDetail->qty;
        $cartDetail->save();
      }
      else {
        $cartDetail = CartDetail::where('cart_id', $cartID)->where('flower_id', $id)->first();
        $cartDetail->qty += $qtyInput;
        // validate the qty Ordered must not exceed the flower Stock
        if ($cartDetail->qty > $flowerStock) {
          return redirect('/flowers/'.$id)->with('error', 'Your order exceed the flower stock limit, Check your Cart');
        }
        $cartDetail->total = Flower::find($id)->price * $cartDetail->qty;
        $cartDetail->save();
      }
      return redirect('/flowers/'.$id)->with('success', 'Adding your Order to your Cart');
    }

    /**Cart Page, remove item from order
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $cartDetail = CartDetail::find($id);
      $cartID = $cartDetail->cart_id;
      $cart = Cart::find($cartID);
      $cartDetail->delete();
      if (is_null($cart->cartDetails)) {
        $cart->delete();
      }
      return redirect('carts/')->with('success', 'Item Removed');
    }
}