<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courier;

class CouriersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $couriers = Courier::orderBy('id', 'asc')->paginate(10);
      return view('couriers.index')->with('couriers', $couriers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('couriers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required|min:3',
        'shippingCost' => 'required|numeric|min:3000'
      ]);
      $courier = new Courier();
      $courier->name = $request->input('name');
      $courier->shippingCost = $request->input('shippingCost');
      $courier->save();
      return redirect('/couriers')->with('success', 'New Courier Inserted');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $courier = Courier::find($id);
      return view('couriers.edit')->with('courier', $courier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name' => 'required|min:3',
        'shippingCost' => 'required|numeric|min:3000'
      ]);
      $courier = Courier::find($id);
      $courier->name = $request->input('name');
      $courier->shippingCost = $request->input('shippingCost');
      $courier->save();
      return redirect('/couriers')->with('success', 'Courier Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $courier = Courier::find($id);
      $courier->delete();
      return redirect('/couriers')->with('success', 'Courier Deleted');
    }

    public function search(Request $request){
      $keyword = $request->input('search');
      $couriers = Courier::where('name', 'like', '%'.$keyword.'%')->orderBy('name','asc')
        ->paginate(10);
      return view('couriers.index')->with('couriers', $couriers);
    }
}
