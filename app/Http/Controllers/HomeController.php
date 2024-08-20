<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist; // Import the Artist class
use App\Models\Album; // Import the Artist class

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // You can pass data to the view if needed
        // For example: $data = ['key' => 'value'];

        $artists = Artist::all();
        $albums = Album::all();
        return view('home', compact('artists', 'albums'));
    }
}
