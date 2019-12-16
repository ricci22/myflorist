<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Flower;
use App\FlowerType;
use App\Transaction;

class FlowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $flowers = Flower::orderBy('name', 'asc')->paginate(10);
      return view('flowers.index')->with('flowers', $flowers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // this for the for dropdown list form label 'type'
      $flowerTypeNames = FlowerType::pluck('name', 'id');

      return view('flowers.create')->with('flowerTypeNames', $flowerTypeNames);
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
        'name' => 'required|unique:flowerTypes|min:4',
        'type' => 'required',
        'price' => 'required|numeric|min:10000',
        'desc' => 'required|min:20|max:200',
        'stock' => 'required|numeric|min:1',
        'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:1024'
      ]);

      $flower = new Flower;
      $flower->name = $request->input('name');
      $flower->flowerTypes_id = $request->input('type');
      $flower->price = $request->input('price');
      $flower->desc = $request->input('desc');
      $flower->stock = $request->input('stock');

      //getting the flower type name
      $type = FlowerType::where('id', $flower->flowerTypes_id)->first();
      $flower->tname = $type->name;

      if ($request->hasFile('cover_image')) {
      // get filename with the extension
      $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
      // get just filename
      $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      // get just ext
      $extension = $request->file('cover_image')->getClientOriginalExtension();
      // filename to store
      $fileNameToStore = $fileName.'_'.time().'.'.$extension;
      // upload image to folder
      $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
    }
      $flower->cover_image = $fileNameToStore;

      $flower->save();
      return redirect('/flowers')->with('success', 'New Flower Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $flower = Flower::find($id);
      return view('pages.show')->with('flower', $flower);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // this for the for dropdown list form label 'type'
      $flowerTypes = new FlowerType();
      $flowerTypeNames = $flowerTypes::pluck('name', 'id');

      $flower = Flower::find($id);

      return view('flowers.edit')->with('flower', $flower)
        ->with('flowerTypeNames', $flowerTypeNames);
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
        'name' => 'required|unique:flowerTypes|min:4',
        'type' => 'required',
        'price' => 'required|numeric|min:10000',
        'desc' => 'required|min:20|max:200',
        'stock' => 'required|numeric|min:1',
        'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:1024'
      ]);

      $flower = Flower::find($id);
      $flower->name = $request->input('name');
      $flower->flowerTypes_id = $request->input('type');
      $flower->price = $request->input('price');
      $flower->desc = $request->input('desc');
      $flower->stock = $request->input('stock');

      // getting the flower type name
      $type = FlowerType::where('id', $flower->flowerTypes_id)->first();
      $flower->tname = $type->name;

      if ($request->hasFile('cover_image')) {
        // get filename with the extension
        $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
        // get just filename
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        // get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // filename to store
        $fileNameToStore = $fileName.'_'.time().'.'.$extension;
        // upload image to folder
        $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
      }
      $flower->cover_image = $fileNameToStore;

      $flower->save();
      return redirect('/flowers')->with('success', 'Flower Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $flower = Flower::find($id);
      Storage::delete('public/cover_image/'.$flower->cover_image);
      $flower->delete();
      return redirect('/flowers')->with('success', 'Flower Deleted');
    }

    // To return the search result from keyword request
    public function search(Request $request){
      $keyword = $request->input('search');
      $flowers = Flower::where('name', 'like', '%'.$keyword.'%')->orderBy('name','asc')
        ->paginate(10);
      return view('pages.index')->with('flowers', $flowers);
    }
}
