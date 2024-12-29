@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <!-- Welcome Section -->
    <div class="text-center mb-5">
        <h1>Welcome to MusicStream</h1>
        <p>Your ultimate destination for music streaming. Discover new artists, explore albums, and immerse yourself in endless tunes.</p>
    </div>

    <!-- Artist Section -->
    <div class="mb-5">
        <h2 class="text-center mb-4">Featured Artists</h2>
        <div id="artistCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($artists as $key => $artist)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $artist->photo) }}" class="d-block mx-auto rounded-circle" alt="{{ $artist->name }}" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $artist->name }}</h5>
                            <p>{{ $artist->genre }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#artistCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#artistCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>

    <!-- Album Section -->
    <div class="mb-5">
        <h2 class="text-center mb-4">Latest Albums</h2>
        <div id="albumCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($albums as $key => $album)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $album->cover_image) }}" class="d-block mx-auto" alt="{{ $album->title }}" style="width: 200px; height: 200px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $album->title }}</h5>
                            <p>By {{ $album->artist->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#albumCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#albumCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>

    <!-- Call-to-Action Section -->
    <div class="text-center mt-5">
        <h3>Start Your Music Journey Today</h3>
        <p>Sign up for free and create your personalized playlist.</p>
        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
    </div>

</div>
@endsection
