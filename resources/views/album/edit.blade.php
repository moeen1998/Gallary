@extends('layouts.app')

@section('style')
<style>
  .header{
    background-color: rgba(0, 0, 0, 0.03);
  }
</style>
    
@endsection

@section('content')
<div class="header py-4 my-2">
  <div class="container">
    <div class="row">
      <h3 class="text-capitalize">You Are Editing <span class="text-info">{{ $album->name }} </span>Album</h3>
      <form action="{{ route('album.update',$album->id) }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row">
          <div class="col-md-5 pt-2">
            <strong>Title:</strong>
            <input type="text" name="title" class="form-control" placeholder="Title" required value="{{ $album->name }}">
          </div>
          <div class="col-md-5 pt-2">
            <strong>The Cover Image:</strong>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="col-md-2 pt-2">
            <br/>
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </div>
      </form> 
    </div>
  </div>
</div>
@endsection
