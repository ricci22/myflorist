<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'phone' => ['required', 'numeric', 'digits_between:8,12'],
            'gender' => ['required', 'in:male,female'],
            'address' => ['required', 'min:10'],
            'picture' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1024']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request, array $data)
    {

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

      return User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'password' => Hash::make($data['password']),
          'phone' => (string)$data['phone'],
          'gender' => $data['gender'],
          'address' => $data['address'],
          'picture' => $fileNameToStore
      ]);
    }
}
