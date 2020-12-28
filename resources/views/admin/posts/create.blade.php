@extends('layouts.app')

@section('styles')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css"
rel="stylesheet">
@stop

@section('content')
<div class="card">
    <div class="card-header">{{ __('CreatePost') }}</div>
    <div class="card-body">
       @include('admin.includes.errors')
                  <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                       @csrf
                        <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                              <label for="featured">Featured image</label>
                              <input type="file" name="featured" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="category">Select a Category</label>
                            <select name="category_id" id="category" class="form-control">
                                  @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="tags">Select tags</label>
                        @foreach($tags as $tag)
                              <div class="checkbox">
                                   <input type="checkbox" name="tags[]" value="{{ $tag->id }}" >
                                   <label for="">{{ $tag->tag }}</label>
                              </div>
                        @endforeach
                  </div>

                        <div class="form-group">
                              <label for="content">Content</label>
                              <textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Store post
                                    </button>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
    </div>
@stop



@section('styles')

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@stop

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
<script>
      $(document).ready(function() {
            $('#content').summernote();
      });
</script>
@stop
