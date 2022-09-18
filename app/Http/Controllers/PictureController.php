<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    // add picture to specific album
    public function add($id , Request $request)
    {
        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('imgs'), $input['image']);
        $album = Picture::create([
            'name' => $request->title,
            'src' => $input['image'],
            'album_id' => $id,

        ]);
        return redirect(route('album.show',$id));
    }

    // remove picture from album
    public function destroy($id ,Picture $picture)
    {
        unlink(public_path('imgs\\'.$picture->src));
        $picture->delete();
        return redirect(route('album.show',$id));
    }
}
