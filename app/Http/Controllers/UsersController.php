<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // authenticat if the user is Admin (user_id == 1)
      if (Auth::id() == 1) {
        $users = User::orderBy('id', 'asc')->paginate(8);
        return view('users.index')->with('users', $users);
      }
      return redirect('/')->with('error', 'Unauthorized User');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      $id = Auth::user()->id;
      $user = User::find($id);
      return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::find($id);
      return view('users.edit')->with('user', $user);
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
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users',
        'phone' => 'required|numeric|digits_between:8,12',
        'gender' => 'required|in:male,female',
        'address' => 'required|min:10',
        'picture' => 'required|image|mimes:jpeg,png,jpg|max:1024'
      ]);

      // get filename with the extension
      $fileNameWithExt = $request->file('picture')->getClientOriginalName();
      // get just filename
      $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      // get just ext
      $extension = $request->file('picture')->getClientOriginalExtension();
      // filename to store
      $fileNameToStore = $fileName.'_'.time().'.'.$extension;
      // upload image to folder
      $path = $request->file('picture')->storeAs('public/pictures', $fileNameToStore);

      $user = User::find($id);
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->phone = $request->input('phone');
      $user->gender = $request->input('gender');
      $user->address = $request->input('address');
      $user->picture = $fileNameToStore;
      $user->save();

      return redirect('/users')->with('success', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
