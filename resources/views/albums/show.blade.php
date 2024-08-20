@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $album->title }}</h2>
    <p>Artist: {{ $album->artist->name }}</p>
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
@endsection
