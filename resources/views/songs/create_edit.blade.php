@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">{{ isset($song) ? 'Edit Song' : 'Add New Song' }}</h2>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form method="POST" action="{{ isset($song) ? route('songs.update', $song->id) : route('songs.store') }}" enctype="multipart/form-data">
                @csrf
                @if(isset($song))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $song->title ?? '') }}" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="artist_id" class="form-label">Artist</label>
                    <select id="artist_id" class="form-select select2 @error('artist_id') is-invalid @enderror" name="artist_id" required>
                        <option value="">Select an artist</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ (isset($song) && $song->artist_id == $artist->id) ? 'selected' : '' }}>{{ $artist->name }}</option>
                        @endforeach
                    </select>
                    @error('artist_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="album_id" class="form-label">Album</label>
                    <select id="album_id" class="form-select select2 @error('album_id') is-invalid @enderror" name="album_id" required>
                        <option value="">Select an album</option>
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}" {{ (isset($song) && $song->album_id == $album->id) ? 'selected' : '' }}>{{ $album->name }}</option>
                        @endforeach
                    </select>
                    @error('album_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="genre_id" class="form-label">Genre</label>
                    <select id="genre_id" class="form-select select2 @error('genre_id') is-invalid @enderror" name="genre_id" required>
                        <option value="">Select a genre</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ (isset($song) && $song->genre_id == $genre->id) ? 'selected' : '' }}>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                    @error('genre_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description', $song->description ?? '') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <input id="cover_image" type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image">
                    @error('cover_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if(isset($song) && $song->cover_image)
                        <img src="{{ asset('storage/' . $song->cover_image) }}" class="img-fluid mt-3" alt="Current Cover Image">
                    @endif
                </div>

                <!-- New field for lyrics -->
                <div class="mb-3">
                    <label for="lyrics" class="form-label">Lyrics</label>
                    <textarea id="lyrics" class="form-control @error('lyrics') is-invalid @enderror" name="lyrics" rows="6">{{ old('lyrics', $song->lyrics ?? '') }}</textarea>
                    @error('lyrics')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- New field for music audio file -->
                <div class="mb-3">
                    <label for="audio_file" class="form-label">Music Audio File</label>
                    <input id="audio_file" type="file" class="form-control @error('audio_file') is-invalid @enderror" name="audio_file" accept="audio/*">
                    @error('audio_file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if(isset($song) && $song->audio_file)
                        <p class="mt-3">Current audio file: <a href="{{ asset('storage/' . $song->audio_file) }}" target="_blank">Listen</a></p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary w-100">{{ isset($song) ? 'Update Song' : 'Add Song' }}</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#artist_id').select2({
            placeholder: "Select an artist",
            allowClear: true
        });
        $('#album_id').select2({
            placeholder: "Select an album",
            allowClear: true
        });
        $('#genre_id').select2({
            placeholder: "Select a genre",
            allowClear: true
        });
    });
</script>
@endsection
