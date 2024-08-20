@extends('layouts.app')

@section('content')
<div class="container mt-5">
    
    <!-- Artist Carousel -->
    <div id="artistCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($artists as $key => $artist)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $artist->photo) }}" class="d-block w-50 mx-auto" alt="{{ $artist->name }}" style="max-height: 200px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $artist->name }}</h5>
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
    
    <!-- Album Carousel -->
    <div id="albumCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($albums as $key => $album)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $album->cover_image) }}" class="d-block w-50 mx-auto" alt="{{ $album->title }}" style="max-height: 200px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $album->title }}</h5>
                        <p>{{ $album->artist->name }}</p>
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
@endsection
