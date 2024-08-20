<?php

namespace App\Http\Controllers;
use App\Models\Song;
use App\Models\Album; 
use App\Models\Artist; 
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songs = Song::with('album', 'artist', 'genre')->get(); // Fetch all songs with related data
        return view('songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new song.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $albums = Album::all();
        $artists = Artist::all();
        $genres = Genre::all();
        return view('songs.create_edit', compact('albums', 'artists', 'genres'));
    }

    /**
     * Store a newly created song in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('song_covers', 'public');
        }

        Song::create($data);

        return redirect()->route('songs.index')->with('success', 'Song created successfully.');
    }

    /**
     * Display the specified song.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\View\View
     */
    public function show(Song $song)
    {
        return view('songs.show', compact('song'));
    }

    /**
     * Show the form for editing the specified song.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\View\View
     */
    public function edit(Song $song)
    {
        $albums = Album::all();
        $artists = Artist::all();
        $genres = Genre::all();
        return view('songs.create_edit', compact('song', 'albums', 'artists', 'genres'));
    }

    /**
     * Update the specified song in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Song $song)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'release_date' => 'required|date',
            'album_id' => 'required|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'artist_id' => 'required|exists:artists,id',
            'lyrics' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Optional cover image
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            if ($song->cover_image) {
                Storage::disk('public')->delete($song->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
        }

        $song->update($data);

        return redirect()->route('songs.index')->with('success', 'Song updated successfully.');
    }

    /**
     * Remove the specified song from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Song $song)
    {
        if ($song->cover_image) {
            Storage::disk('public')->delete($song->cover_image);
        }
        $song->delete();

        return redirect()->route('songs.index')->with('success', 'Song deleted successfully.');
    }
}
