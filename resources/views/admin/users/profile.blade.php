@extends('layouts.app')

@section('content')

      @include('admin.includes.errors')

      <div class="card">
        <div class="card-header">{{ __('Edit Profile') }}</div>
        <div class="card-body">

            <div class="panel-body">
                  <form action="{{ route('user.profile.update',$user->id) }}" method="post" enctype="multipart/form-data">
                      @csrf

                        <div class="form-group">
                              <label for="name">Username</label>
                              <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                        </div>

                        <div class="form-group">
                              <label for="name">Email</label>
                              <input type="email" name="email"  value="{{ $user->email }}" class="form-control" >
                        </div>

                        <div class="form-group">
                              <label for="name">New Password</label>
                              <input type="text" name="password" class="form-control" disabled  value="{{Crypt::decryptString($user->password)  }}">
                        </div>

                        <div class="form-group">
                              <label for="name">Upload new avatar</label>
                              <input type="file" name="avatar" class="form-control">
                        </div>

                        <div class="form-group">
                              <label for="name">Facebook profile</label>
                              <input type="text" name="facebook"  class="form-control">
                        </div>

                        <div class="form-group">
                              <label for="name">Youtube profile</label>
                              <input type="text" name="youtube"  class="form-control">
                        </div>

                        <div class="form-group">
                              <label for="about">About you</label>
                              <textarea name="about" id="about" cols="6" rows="6" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Update profile
                                    </button>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
@stop
