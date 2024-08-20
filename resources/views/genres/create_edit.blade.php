@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($genre) ? 'Edit Genre' : 'Add New Genre' }}</h2>
    <form method="POST" action="{{ isset($genre) ? route('genres.update', $genre->id) : route('genres.store') }}">
        @csrf
        @if(isset($genre))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $genre->name ?? '') }}" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($genre) ? 'Update Genre' : 'Add Genre' }}</button>
    </form>
</div>
@endsection
