<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the albums.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $albums = Album::with('artist')->get(); // Eager load the artist relationship
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new album.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $artists = Artist::all(); // Fetch all artists
        return view('albums.create_edit', compact('artists'));
    }

    /**
     * Store a newly created album in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'release_date' => 'nullable|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'artist_id' => 'required|exists:artists,id' // Validate artist_id
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('album_covers', 'public');
        }

        Album::create($data);

        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }

    /**
     * Display the specified album.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\View\View
     */
    public function show(Album $album)
    {
        $album->load('artist'); // Eager load the artist relationship
        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified album.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\View\View
     */
    public function edit(Album $album)
    {
        $artists = Artist::all(); // Fetch all artists
        return view('albums.create_edit', compact('album', 'artists'));
    }

    /**
     * Update the specified album in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'release_date' => 'nullable|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'artist_id' => 'required|exists:artists,id' // Validate artist_id
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            if ($album->cover_image) {
                Storage::disk('public')->delete($album->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('album_covers', 'public');
        }

        $album->update($data);

        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
    }

    /**
     * Remove the specified album from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Album $album)
    {
        if ($album->cover_image) {
            Storage::disk('public')->delete($album->cover_image);
        }
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
    }
}
