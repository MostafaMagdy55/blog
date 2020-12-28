@extends('layouts.app')

@section('content')

      <div class="panel panel-default">
            <div class="panel-heading">
                  Users
            </div>
            <div class="panel-body">
                  <table class="table table-hover">
                        <thead>
                              <th>
                                    Image
                              </th>
                              <th>
                                    Name
                              </th>
                              @if(Auth::user()->admin)
                              <th>
                                    Permissions
                              </th>
                              <th>
                                    Delete
                              </th>
                              @endif
                        </thead>

                        <tbody>
                              @if($users->count() > 0)
                                    @foreach($users as $user)
                                          <tr>
                                                <td>
                                                    @if ($user->profile)
                                                    <img src="{{ asset($user->profile->avatar) }}" alt="" width="60px" height="60px" style="border-radius: 50%;">
                                                   @else
                                                     <img src="{{ asset('uploads/avatars/1.png') }}" alt="" width="60px" height="60px" style="border-radius: 50%;">
                                                     @endif
                                                </td>
                                                <td>
                                                      {{ $user->name }}
                                                </td>
                                                @if(Auth::user()->admin)
                                                <td>
                                                      @if($user->admin)
                                                            <a href="{{ route('user.not.admin',$user->id) }}" class="btn btn-xs btn-danger">Remove permissions</a>
                                                      @else
                                                            <a href="{{ route('user.admin', $user->id) }}" class="btn btn-xs btn-success">Make admin</a>
                                                      @endif
                                                </td>
                                                <td>
                                                      @if(Auth::id() !== $user->id)
                                                      <td><form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        <input type="submit"  class="btn btn-xs btn-danger" value="Delete">
                                                      </form>

                                                      </td>
                                                      @endif
                                                </td>
                                                @endif
                                          </tr>
                                    @endforeach
                              @else
                                    <tr>
                                          <th colspan="5" class="text-center">No users</th>
                                    </tr>
                              @endif
                        </tbody>
                  </table>
                  {{ $users->links() }}
            </div>
      </div>

@stop
