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
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'required|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'lyrics' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'audio_file' => 'nullable|mimes:mp3,wav,ogg|max:10240', // 10 MB max
        ]);

        $data = $request->all();

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('song_covers', 'public');
        }

        // Handle audio file upload
        if ($request->hasFile('audio_file')) {
            $data['audio_file'] = $request->file('audio_file')->store('song_audio', 'public');
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
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'required|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'lyrics' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'audio_file' => 'nullable|mimes:mp3,wav,ogg|max:10240', // 10 MB max
        ]);

        $data = $request->all();

        // Handle cover image update
        if ($request->hasFile('cover_image')) {
            if ($song->cover_image) {
                Storage::disk('public')->delete($song->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('song_covers', 'public');
        }

        // Handle audio file update
        if ($request->hasFile('audio_file')) {
            if ($song->audio_file) {
                Storage::disk('public')->delete($song->audio_file);
            }
            $data['audio_file'] = $request->file('audio_file')->store('song_audio', 'public');
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

        if ($song->audio_file) {
            Storage::disk('public')->delete($song->audio_file);
        }

        $song->delete();

        return redirect()->route('songs.index')->with('success', 'Song deleted successfully.');
    }
}
