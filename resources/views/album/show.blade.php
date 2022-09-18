@extends('layouts.app')

@section('style')
<style>
  .header{
    background-color: rgba(0, 0, 0, 0.03);
  }
  .child{
  padding: 10px !important;
  position: relative;
  }
  .child a{
    text-decoration: none;
    text-align: center;
  }
  .child a img{
    width: 100%;
    height: 250px;
    border-radius: 5px 5px 0px 0px
  }
  .delete{
    position: absolute;
    top: 0px;
    right: 0px;
    background-color: #ff3030;
    color: #fff;
    border: 1px solid #ff3030;
    border-radius: 40%;
    font-size: 16px;
    opacity: .9;
    padding: 5px;

  }
</style>
    
@endsection

@section('content')
<div class="header py-4 my-2">
  <div class="container">
    <div class="row">
      <h3>Add Pictures </h3>
      <form action="{{ route('picture.store',$album->id) }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-5 pt-2">
            <strong>Title:</strong>
            <input type="text" name="title" class="form-control" placeholder="Title" required>
          </div>
          <div class="col-md-5 pt-2">
            <strong>Image:</strong>
            <input type="file" name="image" class="form-control" required>
          </div>
          <div class="col-md-2 pt-2">
            <br/>
            <button type="submit" class="btn btn-success">Upload</button>
          </div>
        </div>
      </form> 
    </div>
  </div>
</div>

  <div class="container">
    <div class="row">
      @if ( count($album->pictures) > 0 )

        @foreach ($album->pictures as $picture)
          <div class="child col-sm-6 col-xs-6 col-md-4 col-lg-3">
            <a href="/imgs/{{ $picture->src }}">
              <img class="img-fluid" alt="" src="/imgs/{{ $picture->src }}" />
              <small class="w-100 d-block py-2">{{ $picture->name }}</small>
            </a>
            <form action="{{ route('picture.destroy',[$album->id, $picture->id]) }}" method="POST">
              @csrf
              @method("DELETE")
              <button type="submit" class="delete">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </form>
          </div>
        @endforeach
      @else
        <h3 class="text-center py-4 mt-4">Ther Is No Any Picture Here Add Some...</h3>
      @endif
    </div>
  </div>
@endsection
