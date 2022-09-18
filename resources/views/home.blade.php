@extends('layouts.app')

@section('style')
<style>
    .link{
        text-decoration: none;
        color: rgba(0, 0, 0, .8) !important;
    }
    .link:hover{
        text-decoration: none;
        color: rgba(0, 0, 0, .8);
    }
    .header{
        background-color: rgba(0, 0, 0, 0.03);
    }
    .album{
        height: 250px;
        position: relative;
        margin-top: 20px;
        border: 1px solid #ccc;
        border-radius: 10px
    }
    .album:hover .overlay{display: block}
    .album img{
        width: 100%;
        height: 100%;
        z-index: 1;
        border-radius: 10px
    }
    .album .overlay{
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        background-color: #ccc;
        opacity: .9;
        color: #fff;
        width: 100%;
        height: 100%;
        z-index: 2;
        text-align: center;
        border-radius: 10px
    }
</style>
    
@endsection

@section('content')
    <div class="header py-4 mt-2">
        <div class="container">
            <div class="row">
                <h3>Create Album</h3>
                <form action="{{ route('album.store') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 pt-2">
                            <strong>Title:</strong>
                            <input type="text" name="title" class="form-control" placeholder="Title" required>
                        </div>
                        <div class="col-md-5 pt-2">
                            <strong>Cover Image:</strong>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="col-md-3 pt-2">
                            <br/>
                            <button type="submit" class="btn btn-success">Create Album</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row mt-3">
                @foreach (Auth::user()->albums as $album)
                    <div class="col-md-4 col-sm-6 col-xs-6 col-lg-3 mb-3">
                        <div class="album">
                            <img src="/imgs/{{ $album->cover }}"/>
                            <div class="overlay pt-5 px-4">
                                <h2 class="text-muted mt-2 mb-3">{{ $album->name }}</h2>
                                <a class="link" href="{{ route('album.show',$album->id) }}">
                                    <button class="btn btn-primary"><i class="fa-solid fa-eye"></i></button>
                                </a>
                                <a class="link" href="{{ route('album.edit',$album->id) }}">
                                    <button class="btn btn-success"><i class="fa-solid fa-pen"></i></button>
                                </a>
                                
                                @if(count($album->pictures) > 0)
                                @php
                                    $id = $album->id;
                                @endphp
                                    {{-- <button class="btn btn-danger" onclick="albumdelete({{ $album->id }})"><i class="fa fa-trash"></i></button> --}}
                                    <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#menue" aria-controls="menue" aria-expanded="false">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <ul id="menue" class="dropdown-menu px-3 mt-2" role="menu">
                                        <li>
                                        <form class="d-inline" action="{{ route('album.destroy', $album->id) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            {{-- <a href="#" class="link">Delete All</a> --}}
                                            <input class="btn p-0 link" type="submit" value="Delete All"/>
                                        </form>
                                    </li>
                                        <li>
                                            <a href="#" class="dropdown-toggle link" data-bs-toggle="dropdown">
                                                Move To <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu px-2" role="menu">
                                                @foreach (Auth::user()->albums as $album)
                                                    <a class="link" href="{{ route('moveto', [$album->id,$id]) }}"><li>{{ $album->name }}</li></a>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                @else
                                    <form class="d-inline" action="{{ route('album.destroy', $album->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection