@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $artist->name }}</h2>
    <a href="{{ route('artists.index') }}" class="btn btn-secondary">Back to Artists</a>

    @auth
        @if(Auth::user()->is_admin)
            <a href="{{ route('artists.edit', $artist->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endif
    @endauth

    <div class="mt-4">
        <h3>Biography</h3>
        <p>{{ $artist->bio }}</p>

        <h3>Birth Date</h3>
        @php
            $birthDate = \Carbon\Carbon::parse($artist->birth_date);
        @endphp
        <p>{{ $birthDate->format('F j, Y') }}</p>

        @if($artist->photo)
    <h3>Photo</h3>
    <img src="{{ asset('storage/' . $artist->photo) }}" alt="Artist Photo" class="img-fluid" style="max-height: 300px;">
@endif

    </div>
</div>
@endsection
