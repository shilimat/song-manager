@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-4">
            <!-- Artist Photo Section -->
            @if($artist->photo)
            <div class="mb-4">
                <h3 class="text-center">Photo</h3>
                <img src="{{ asset('storage/' . $artist->photo) }}" alt="Artist Photo" 
                     class="img-fluid rounded shadow-sm" 
                     style="max-height: 300px; width: 100%; object-fit: cover;">
            </div>
            @endif
        </div>

        <div class="col-md-8">
            <!-- Artist Name and Bio Section -->
            <h2 class="mb-3">{{ $artist->name }}</h2>

            <div class="mb-4">
                <h3>Biography</h3>
                <p>{{ $artist->bio }}</p>
            </div>

            <div class="mb-4">
                <h3>Birth Date</h3>
                @php
                    $birthDate = \Carbon\Carbon::parse($artist->birth_date);
                @endphp
                <p>{{ $birthDate->format('F j, Y') }}</p>
            </div>

            <!-- Most Popular Songs Section -->
            <div class="mb-4">
                <h3>Popular Songs</h3>
                @if($topSongs->isNotEmpty())
                    <div class="list-group">
                        @foreach($topSongs as $song)
                        @if($song && $song->artist && $song->album)
                        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center song-item mb-3 shadow-sm rounded"
                             style="padding: 10px;">
                            <div class="d-flex align-items-center w-100">
                                <img src="{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-song-cover.jpg') }}" 
                                     alt="{{ $song->title }}" 
                                     class="img-thumbnail rounded-circle me-3" 
                                     style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="text-truncate" style="width: calc(100% - 180px);">
                                    <h6 class="mb-1 text-truncate">{{ $song->title }}</h6>
                                    <div class="text-muted small">
                                        <span class="me-2">Artist: {{ $song->artist->name }}</span>
                                        <span>Album: {{ $song->album->name }}</span>
                                    </div>
                                </div>
                            </div>
                            @auth
                            @if(Auth::user()->is_admin)
                            <div class="d-flex align-items-center">
                                <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-sm btn-warning me-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('songs.destroy', $song->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                            @endauth
                        </div>
                        @endif
                        @endforeach
                    </div>
                @else
                    <p>No popular songs found for this artist yet.</p>
                @endif
            </div>

            @auth
                @if(Auth::user()->is_admin)
                <div class="mt-4">
                    <a href="{{ route('artists.edit', $artist->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
                @endif
            @endauth

            <div class="mt-3">
                <a href="{{ route('artists.index') }}" class="btn btn-secondary btn-sm">Back to Artists</a>
            </div>
        </div>
    </div>
</div>
@endsection
