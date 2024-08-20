@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Songs</h2>
    
    @auth
    @if(Auth::user()->is_admin)
    <a href="{{ route('songs.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Add New Song
    </a>
    @endif
    @endauth

    <div class="list-group">
        @foreach($songs as $song)
        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center song-item mb-2 p-2 shadow-sm rounded" data-url="{{ Auth::user()->is_admin ? route('songs.show', $song->id) : (Auth::user()->is_subscribed && (Auth::user()->subscription_expires_at > now()) ? route('songs.show', $song->id) : route('payment', $song->id)) }}" style="cursor: pointer;">
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
