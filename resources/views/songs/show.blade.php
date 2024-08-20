@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row">
        <!-- Song Cover Image -->
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $song->cover_image) }}" class="img-fluid rounded mb-3" alt="{{ $song->title }}">
        </div>
        <!-- Song Details -->
        <div class="col-md-8">
            <h2>{{ $song->title }}</h2>
            <p><strong>Artist:</strong> {{ $song->artist->name }}</p>
            <p><strong>Album:</strong> {{ $song->album->name }}</p>
            <p><strong>Genre:</strong> {{ $song->genre->name }}</p>
            <p><strong>Duration:</strong> {{ $song->duration }}</p>
            <p><strong>Release Date:</strong> 
                {{ $song->release_date ? $song->release_date->format('F j, Y') : 'N/A' }}
            </p>
            <p><strong>Lyrics:</strong></p>
            <pre>{{ $song->lyrics }}</pre>
            <a href="{{ route('songs.index') }}" class="btn btn-secondary mt-3">Back to Songs</a>
        </div>
    </div>
</div>
@endsection
