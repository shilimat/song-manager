@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ $genre->name }}</h2>
    <a href="{{ route('genres.index') }}" class="btn btn-secondary mb-3">Back to Genres</a>

    @auth
    @if(Auth::user()->is_admin)
    <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning mb-3">
        <i class="fas fa-edit"></i> Edit
    </a>
    <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mb-3">
            <i class="fas fa-trash"></i> Delete
        </button>
    </form>
    @endif
    @endauth

    <hr>

    <h4>Songs in {{ $genre->name }}:</h4>
    @if($genre->songs->isEmpty())
        <p>No songs available in this genre.</p>
    @else
        <div class="list-group">
            @foreach($genre->songs as $song)
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center song-item mb-2 p-2 shadow-sm rounded" data-url="{{ route('songs.show', $song->id) }}" style="cursor: pointer;">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" class="img-thumbnail rounded-circle me-2" style="width: 40px; height: 40px;">
                    <div>
                        <h6 class="mb-1">{{ $song->title }}</h6>
                        <div class="text-muted small">
                            <span class="me-2">Artist: {{ $song->artist->name }}</span>
                            <span>Album: {{ $song->album->name }}</span>
                        </div>
                    </div>
                </div>
                @auth
                @if(Auth::user()->is_admin)
                <div class="text-end">
                    <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-sm btn-warning me-1">
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
            @endforeach
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.song-item').forEach(function (item) {
            item.addEventListener('click', function () {
                window.location.href = this.getAttribute('data-url');
            });
        });
    });
</script>
@endsection
