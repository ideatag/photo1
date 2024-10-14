<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{

    public function upload(Request $request, $albumId)
    {
        $request->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $album = Album::where('id', $albumId)->where('user_id', Auth::id())->firstOrFail();


        if ($request->hasfile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('uploads', 'public');
                Photo::create([
                    'path' => $path,
                    'album_id' => $album->id,
                    'user_id' => Auth::id(),
                ]);
            }
        }

        return redirect()->route('albums.show', $album->id)
                         ->with('success', 'Photos uploaded successfully.');
    }
}
