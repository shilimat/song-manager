@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($artist) ? 'Edit Artist' : 'Add New Artist' }}</h2>
    <form method="POST" action="{{ isset($artist) ? route('artists.update', $artist->id) : route('artists.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($artist))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $artist->name ?? '') }}" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio" rows="3">{{ old('bio', $artist->bio ?? '') }}</textarea>
            @error('bio')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="birth_date" class="form-label">Birth Date</label>
            <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date', $artist->birth_date ?? '') }}" required>
            @error('birth_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
            @if(isset($artist) && $artist->photo)
                <img src="{{ asset('storage/' . $artist->photo) }}" alt="Artist Photo" class="mt-2" style="max-height: 150px;">
            @endif
            @error('photo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($artist) ? 'Update Artist' : 'Add Artist' }}</button>
    </form>
</div>
@endsection
