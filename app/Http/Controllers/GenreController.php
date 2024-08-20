<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the genres.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $genres = Genre::all(); // Fetch all genres
        return view('genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new genre.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('genres.create_edit');
    }

    /**
     * Store a newly created genre in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Genre::create($request->all());

        return redirect()->route('genres.index')->with('success', 'Genre created successfully.');
    }

    /**
     * Display the specified genre.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $genre = Genre::with('songs')->findOrFail($id);
        return view('genres.show', compact('genre'));
    }




    /**
     * Show the form for editing the specified genre.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\View\View
     */
    public function edit(Genre $genre)
    {
        return view('genres.create_edit', compact('genre'));
    }

    /**
     * Update the specified genre in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $genre->update($request->all());

        return redirect()->route('genres.index')->with('success', 'Genre updated successfully.');
    }

    /**
     * Remove the specified genre from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genres.index')->with('success', 'Genre deleted successfully.');
    }
}
