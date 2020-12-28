@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>
    <div class="card-body">
       @include('admin.includes.errors')
                  <form action="{{ route('posts.update',$post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                        </div>

                        <div class="form-group">
                              <label for="featured">Featured image</label>
                              <input type="file" name="featured" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="category">Select a Category</label>
                            <select name="category_id" id="category" class="form-control">
                                  @foreach(App\Category::all() as $category)
                                  @if ($post->category_id==$category->id)
                                     <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                 @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                 @endif
                                  @endforeach
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="tags">Select tags</label>
                        @foreach($tags as $tag)
                              <div class="checkbox">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"

                                @foreach ($post->tags as $ta)
                                    @if ($ta->id==$tag->id)
                                        checked
                                    @endif
                                @endforeach
                                >
                                <label for="">{{ $tag->tag }}</label>
                              </div>
                        @endforeach
                  </div>

                        <div class="form-group">
                              <label for="content">Content</label>
                              <textarea name="content" id="content" cols="5" rows="5" class="form-control">{{ $post->content }}</textarea>
                        </div>

                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Update post
                                    </button>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
    </div>
@stop
