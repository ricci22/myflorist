<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flower;
use PhpParser\Node\Stmt\ClassLike;

class PagesController extends Controller
{
    public function index(){
      $flowers = Flower::orderBy('name', 'asc')->paginate(10);
      return view('pages.index')->with('flowers', $flowers);
    }

    // To return the search result from keyword request
    public function search(Request $request){
      $keyword = $request->input('search');
      $flowers = Flower::where('name', 'like', '%'.$keyword.'%')->orderBy('name','asc')
        ->paginate(10);
      return view('pages.index')->with('flowers', $flowers);
    }

    // To show detail of flower and add to cart page
    public function show($id)
    {
      $flower = Flower::find($id);
      return view('pages.show')->with('flower', $flower);
    }
}
