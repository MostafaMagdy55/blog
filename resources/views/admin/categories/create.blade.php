@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')

      <div class="card">
        <div class="card-header">{{ __('Create Category') }}</div>
        <div class="card-body">

                  <form action="{{ route('categories.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                              <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                          Store category
                                    </button>
                              </div>
                        </div>
                  </form>
            </div>
      </div>
@stop
