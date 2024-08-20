@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Genres</h2>
    @auth
    @if(Auth::user()->is_admin)
    <a href="{{ route('genres.create') }}" class="btn btn-primary mb-3">Add New Genre</a>
    @endif
    @endauth

    <div class="list-group">
        @foreach($genres as $genre)
        <a href="{{ route('genres.show', $genre->id) }}" class="list-group-item list-group-item-action">
            {{ $genre->name }}
        </a>
        @endforeach
    </div>
</div>
@endsection
