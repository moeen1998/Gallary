<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    // create album
    public function store(StoreAlbumRequest $request)
    {
        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('imgs'), $input['image']);
        Album::create([
            'name' => $request->title,
            'cover' => $input['image'],
            'user_id' => Auth::user()->id,

        ]);
        return redirect(route('home'));
    }

    // return album with all images to show
    public function show(Album $album)
    {
        return view('album.show',compact('album'));
    }

    // return album details to edit
    public function edit(Album $album)
    {
        return view('album.edit',compact('album'));
    }

    // update album data 
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        if($request->image)
        {
            //delete the old image
            unlink(public_path('imgs\\'.$album->cover));
            
            // add the new one
            $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('imgs'), $input['image']);
            $album->update([
                'name' => $request->title,
                'cover' => $input['image'],
            ]);
        }
        else
        {
            $album->update([
                'name' => $request->title,
            ]);
        }
        return redirect(route('home'));
    }

    // empty album and delete
    public function moveto($to ,Album $album)
    {
        if($to !== $album->id)
        {
            foreach($album->pictures as $picture)
            {
                $picture->update(['album_id' => $to]);
            }
            unlink(public_path('imgs\\'.$album->cover));
            $album->delete();
        }
        return redirect(route('home'));
    }

    // remove album with all pitures
    public function destroy(Album $album)
    {
        unlink(public_path('imgs\\'.$album->cover));
        foreach($album->pictures as $picture)
            {
                unlink(public_path('imgs\\'.$picture->src));
            }
        $album->delete();
        return redirect(route('home'));
    }
}
