@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($album) ? 'Edit Album' : 'Add New Album' }}</h2>
    <form method="POST" action="{{ isset($album) ? route('albums.update', $album->id) : route('albums.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($album))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $album->name ?? '') }}" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="release_date" class="form-label">Release Date</label>
            <input id="release_date" type="date" class="form-control @error('release_date') is-invalid @enderror" name="release_date" value="{{ old('release_date', $album->release_date ?? '') }}" required>
            @error('release_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover Image</label>
            <input id="cover_image" type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image">
            @if(isset($album) && $album->cover_image)
                <img src="{{ asset('storage/' . $album->cover_image) }}" alt="Cover Image" class="mt-2" style="max-height: 150px;">
            @endif
            @error('cover_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description', $album->description ?? '') }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="artist_id" class="form-label">Artist</label>
            <select id="artist_id" class="form-select @error('artist_id') is-invalid @enderror" name="artist_id" required>
                @foreach($artists as $artist)
                    <option value="{{ $artist->id }}" {{ (isset($album) && $album->artist_id == $artist->id) ? 'selected' : '' }}>{{ $artist->name }}</option>
                @endforeach
            </select>
            @error('artist_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($album) ? 'Update Album' : 'Add Album' }}</button>
    </form>
</div>

<!-- Add this script before the closing </body> tag -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#artist_id').select2({
            placeholder: "Select an artist",
            allowClear: true
        });
    });
</script>
@endsection
