@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row">
        <!-- Album Cover and Details -->
        <div class="col-md-5 col-lg-4 text-center mb-4">
            @if($album->cover_image)
            <img 
                src="{{ asset('storage/' . $album->cover_image) }}" 
                alt="{{ $album->title }}" 
                class="img-fluid rounded shadow mb-3" 
                style="width: 100%; object-fit: cover; max-height: 350px;"
            >
            @endif
            <h2 class="fw-bold">{{ $album->title }}</h2>
            <p>
                <strong>Artist:</strong> 
                <a href="{{ route('artists.show', $album->artist->id) }}" class="text-primary">
                    {{ $album->artist->name }}
                </a>
            </p>
            <p><strong>Release Date:</strong> {{ $album->release_date ?? 'Unknown' }}</p>
        </div>

        <!-- Album Description -->
        <div class="col-md-7 col-lg-8">
            <h4 class="fw-bold text-secondary mb-3">Description</h4>
            <p>{{ $album->description ?? 'No description available for this album.' }}</p>

            <hr class="my-4">

            <h4 class="fw-bold text-secondary">Songs in this Album</h4>
            @if($album->songs->isEmpty())
            <p class="text-muted">No songs available in this album.</p>
            @else
            <div class="list-group">
                @foreach($album->songs as $song)
                <a 
                    href="{{ Auth::user()->is_admin ? route('songs.show', $song->id) : (Auth::user()->is_subscribed && (Auth::user()->subscription_expires_at > now()) ? route('songs.show', $song->id) : route('payment', $song->id)) }}" 
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center song-item mb-2 p-2 shadow-sm rounded"
                    style="cursor: pointer;">
                    <div class="d-flex align-items-center">
                        @if($song->cover_image)
                        <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" class="img-thumbnail rounded-circle me-2" style="width: 40px; height: 40px;">
                        @endif
                        <div>
                            <h6 class="mb-1">{{ $song->title }}</h6>
                            <div class="text-muted small">
                                <span class="me-2">Artist: {{ $song->artist->name }}</span>
                                <span>Album: {{ $album->name }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('albums.index') }}" class="btn btn-secondary">Back to Albums</a>
        @auth
        @if(Auth::user()->is_admin)
        <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @endif
        @endauth
    </div>
</div>

@endsection
