<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\TransactionDetails;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
  /**
   * Display a listing of the transaction.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (Auth::id() == 1) {
      $transactions = Transaction::all();
      $transactionDetails = TransactionDetails::all();
      return view('transactions.index')->with(compact('transactions', 'transactionDetails'));
    }
    return redirect('/')->with('error', 'Unauthorized User');
  }

  public function orderIndex()
  {
    if (Auth::check()) {
      $id = Auth::id();
      $transactions = Transaction::where('user_id', $id)->get();
      $transactionDetails = TransactionDetails::all();
      return view('order.index')->with(compact('transactions', 'transactionDetails'));
    }
  }
}
