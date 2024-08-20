@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Albums</h2>
    @auth
    @if(Auth::user()->is_admin)
    <a href="{{ route('albums.create') }}" class="btn btn-primary mb-3">Add New Album</a>
    @endif
    @endauth

    <!-- Search Form -->
    <form method="GET" action="{{ route('albums.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search albums..." value="{{ request('query') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Custom Styles -->
    <style>
        .album-card {
            width: 250px; /* Set width */
            height: 250px; /* Set height to be the same as width */
            margin: auto;
            overflow: hidden; /* Ensure content does not overflow */
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .album-card img {
            width: 100%;
            height: 100%; /* Ensure image fills the card */
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        .album-card .card-body {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            color: white; /* Text color */
            text-align: center;
            transition: background 0.3s ease;
        }

        .album-card:hover {
            transform: scale(1.05); /* Slightly enlarge card on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow */
        }

        .album-card:hover .card-body {
            background: rgba(0, 0, 0, 0.7); /* Darken background on hover */
        }
    </style>

    <!-- Album Cards -->
    <div class="row">
        @forelse($albums as $album)
        <div class="col-md-3 mb-3">
            <div class="card album-card">
                <a href="{{ route('albums.show', $album->id) }}" class="text-decoration-none text-dark">
                    <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $album->name }}</h5>
                    </div>
                </a>
            </div>
        </div>
        @empty
        <p>No albums found.</p>
        @endforelse
    </div>
</div>
@endsection
