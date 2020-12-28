@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">{{ __('All Post') }}</div>
    <div class="card-body">
                  <table class="table table-hover">
                        <thead>
                              <th>
                                    Image
                              </th>
                              <th>
                                    Title
                              </th>
                              <th>
                                    Edit
                              </th>
                              <th>
                                    Trash
                              </th>
                        </thead>

                        <tbody>
                              @if($posts->count() > 0)
                                    @foreach($posts as $post)
                                          <tr>
                                                <td><img src="{{ $post->featured }}" alt="{{ $post->title }}" width="90px" height="50px"></td>
                                                <td>{{ $post->title }}</td>

                                                @if(Auth::user()->id==$post->user->id || Auth::user()->admin)
                                                <td>
                                                      <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-xs btn-info">Edit</a>
                                                </td>

                                                <td><form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="submit"  class="btn btn-xs btn-danger" value="Trashed">

                                                    @endif
                                                  </form>

                                                  </td>
                                          </tr>

                                    @endforeach




                              @else
                                    <tr>
                                          <th colspan="5" class="text-center">No published posts</th>
                                    </tr>
                              @endif
                        </tbody>
                  </table>
                  <div class="center">

                        {{ $posts->links() }}

                </div>

            </div>
      </div>

@stop

