<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MostPlayed;

class ArtistController extends Controller
{
    /**
     * Display a listing of the artists.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $artists = Artist::all(); // Fetch all artists
        return view('artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new artist.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('artists.create_edit');
    }

    /**
     * Store a newly created artist in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Optional photo
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('artist_photos', 'public');
        }

        Artist::create($data);

        return redirect()->route('artists.index')->with('success', 'Artist created successfully.');
    }

    /**
     * Display the specified artist.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\View\View
     */
    public function show(Artist $artist)
    {
        $topSongs = MostPlayed::getTopSongsByTotalPlayCount($artist->id);
        return view('artists.show', compact('artist', 'topSongs'));
    }

    /**
     * Show the form for editing the specified artist.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\View\View
     */
    public function edit(Artist $artist)
    {
        return view('artists.create_edit', compact('artist'));
    }

    /**
     * Update the specified artist in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Optional photo
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($artist->photo) {
                Storage::disk('public')->delete($artist->photo);
            }
            $data['photo'] = $request->file('photo')->store('artist_photos', 'public');
        }

        $artist->update($data);

        return redirect()->route('artists.index')->with('success', 'Artist updated successfully.');
    }

    /**
     * Remove the specified artist from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Artist $artist)
    {
        if ($artist->photo) {
            Storage::disk('public')->delete($artist->photo);
        }
        $artist->delete();

        return redirect()->route('artists.index')->with('success', 'Artist deleted successfully.');
    }
}
