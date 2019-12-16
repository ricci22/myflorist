@extends('layouts.app')
@section('title')
  Manage Users
@endsection
@section('content')
  @if(count($users) > 0)
    <div class="container mt-3">
      <div class="row justify-content-center">
          <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
              <th scope="col">Picture</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Gender</th>
              <th scope="col">Address</th>
              <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr>
                <td width="20%"><img class="card-img" height="50%" src="/storage/pictures/{{$user->picture}}" alt="Card image cap"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->gender}}</td>
                <td>{{$user->address}}</td>
                <td width="15%">
                  <div class="row">
                    <a href="/users/{{$user->id}}/edit" class="btn btn-dark float-left">Update</a>
                    @if ($user->id == 1)
                      <h7>You can't remove Admin</h7>
                    @else
                    <form action="/users/{{$user->id}}" method="post">
                      @csrf
                      @method('delete')
                      <input type="submit" class="btn btn-secondary" value="Remove">
                    </form>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
      </div>
    </div>
  @else
    <h3 class="row justify-content-center m-lg-5 text-danger">No Users Found!</h3>
  @endif
  <div class="row justify-content-center">
    @if(count($users) > 0)
      {{$users->links()}}
    @endif
  </div>
@endsection