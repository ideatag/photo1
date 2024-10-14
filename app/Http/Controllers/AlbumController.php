<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch albums that belong to the authenticated user
        $albums = Album::with('photos')->where('user_id', Auth::id())->get();
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create an album');
        }

        $request->validate([
            'title' => 'required|string|max:255',
        ]);


        Album::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }

    public function edit($id)
    {
        $album = Album::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);


        $album = Album::where('id', $id)->where('user_id', Auth::id())->firstOrFail();


        $album->title = $request->title;
        $album->save();


        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $album = Album::with('photos')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('albums.show', compact('album'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $album = Album::where('id', $id)->where('user_id', Auth::id())->firstOrFail();


        $album->photos()->delete();


        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
    }
}
