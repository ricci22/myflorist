<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FlowerType;

class FlowerTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flowerTypes = FlowerType::orderBy('name', 'asc')->paginate(10);
        return view('flower_types.index')->with('flowerTypes', $flowerTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flower_types.create');
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
        'name' => 'required|unique:flowerTypes|min:4'
      ]);
      $flowerTypes = new FlowerType;
      $flowerTypes->name = $request->input('name');
      $flowerTypes->save();
      return redirect('flower_types')->with('success', 'New Flower Types Inserted');
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
      $flowerType = FlowerType::find($id);
      return view('flower_types.edit')->with('flowerType', $flowerType);
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
        'name' => 'required|unique:flowerTypes|min:4'
      ]);
      $flowerType = FlowerType::find($id);
      $flowerType->name = $request->input('name');
      $flowerType->save();
      return redirect('/flower_types')->with('success', 'Flower Type Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $flowerType = FlowerType::find($id);
      $flowerType->delete();
      return redirect('/flower_types')->with('success', 'Flower Type Deleted');
    }

    // To return the search result from input keyword
    public function search(Request $request){
      $keyword = $request->input('search');
      $flowerTypes = FlowerType::where('name', 'like', '%'.$keyword.'%')->orderBy('name','asc')
        ->paginate(10);
      return view('flower_types.index')->with('flowerTypes', $flowerTypes);
    }
}
