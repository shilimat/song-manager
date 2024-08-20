@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Artists</h2>
    @auth
    @if(Auth::user()->is_admin)
    <a href="{{ route('artists.create') }}" class="btn btn-primary mb-3">Add New Artist</a>
    @endif
    @endauth

    <div class="artist-container">
        @foreach($artists as $artist)
        <a href="{{ route('artists.show', $artist->id) }}" class="artist-item text-center d-block">
            <img src="{{ asset('storage/' . $artist->photo) }}" alt="{{ $artist->name }}" class="img-fluid rounded-circle">
            <h6 class="mt-2 artist-name">{{ $artist->name }}</h6>
        </a>
        @endforeach
    </div>
</div>

<style>
.artist-container {
    display: flex; /* Use flexbox to align items in a row */
    flex-wrap: nowrap; /* Prevent items from wrapping to the next line */
    overflow-x: auto; /* Enable horizontal scrolling if necessary */
    padding: 10px 0; /* Add some vertical padding */
}

.artist-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-right: 10px; /* Space between items */
    text-decoration: none; /* Remove underline from links */
}

.artist-item:hover {
    text-decoration: none; /* Ensure no underline on hover */
}

.artist-item img {
    width: 100px; /* Adjust size as needed */
    height: 100px; /* Adjust size as needed */
    object-fit: cover;
}

.artist-name {
    font-size: 0.875rem; /* Make the name smaller */
    color: #333; /* Optional: adjust color if needed */
}
</style>
@endsection
