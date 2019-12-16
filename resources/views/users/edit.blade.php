@extends('layouts.app')
@section('title')
  Update User
@endsection
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Update') }}</div>
          <div class="card-body">
            <form method="POST" action="/users/{{$user->id}}" enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{$user->name}}" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{$user->email}}" value="{{ old('email') }}" required autocomplete="email">
                </div>
              </div>

              <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                <div class="col-md-6">
                  <input id="phone" type="number" class="form-control" name="phone" placeholder="{{(int)$user->phone}}" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                <div class="col-md-6">
                  @if($user->gender == "male")
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="male" checked>Male
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="female">Female
                      </label>
                    </div>
                  @else
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="male">Male
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="female" checked>Female
                      </label>
                    </div>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                <div class="col-md-6">
                  <textarea name="address" class="form-control" placeholder="{{$user->address}}"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Profile Pictures</label>
                <div class="col-md-6">
                  <input type="file" name="picture">
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
