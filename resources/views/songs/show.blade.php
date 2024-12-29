@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row align-items-center">
        <div class="col-md-4 text-center">
            <img 
                src="{{ asset('storage/' . $song->cover_image) }}" 
                class="img-fluid rounded mb-3 shadow" 
                alt="{{ $song->title }}" 
                style="width: 300px; height: 300px; object-fit: cover;"
            >
            <h3 class="text-dark fw-bold mt-3">{{ $song->title }}</h3>
            <p class="text-muted mb-1"><strong>Artist:</strong> {{ $song->artist->name }}</p>
            <p class="text-muted"><strong>Genre:</strong> {{ $song->genre->name }}</p>
        </div>

        <div class="col-md-8">
            <h5 class="text-primary">Lyrics</h5>
            <div class="card shadow p-4" style="max-height: 300px; overflow-y: auto;">
                <pre class="mb-0">{{ $song->lyrics }}</pre>
            </div>
        </div>
    </div>
</div>

<div class="music-player fixed-bottom bg-dark text-white py-3 shadow-lg">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img 
                src="{{ asset('storage/' . $song->cover_image) }}" 
                class="rounded me-3" 
                alt="{{ $song->title }}" 
                style="width: 60px; height: 60px; object-fit: cover;"
            >
            <div>
                <h6 class="mb-0 fw-bold">{{ $song->title }}</h6>
                <small class="text-muted">{{ $song->artist->name }}</small>
            </div>
        </div>

        <div class="player-controls d-flex align-items-center">
            <audio id="audioPlayer" src="{{ asset('storage/' . $song->audio_file) }}" preload="auto"></audio>
            <button id="prevTrackBtn" class="btn btn-outline-light btn-sm mx-2">
                <i class="fa fa-step-backward"></i>
            </button>
            <button id="playPauseBtn" class="btn btn-primary btn-sm mx-2"> 
                <i class="fa fa-play"></i>
            </button>
            <button id="nextTrackBtn" class="btn btn-outline-light btn-sm mx-2">
                <i class="fa fa-step-forward"></i>
            </button>
        </div>

        <div class="progress-container flex-grow-1 mx-4">
            <div class="progress" style="height: 5px;">
                <div id="progressBar" class="progress-bar bg-success" style="width: 0%;"></div>
            </div>
            <div class="d-flex justify-content-between small text-white-50 mt-1">
                <span id="currentTime">0:00</span>
                <span id="duration">0:00</span>
            </div>
        </div>

        <div class="volume-control d-flex align-items-center">
            <button id="volumeButton" class="btn btn-outline-light btn-sm d-flex align-items-center">
                <i id="volumeIcon" class="fa fa-volume-up"></i>
            </button>
            <input 
                type="range" 
                id="volumeSlider" 
                class="form-range mx-2 volume-slider" 
                min="0" 
                max="1" 
                step="0.1" 
                value="0.5" 
                style="width: 120px;"
            >
        </div>

        <!-- Share Icon -->
        <button id="shareButton" class="btn btn-outline-light btn-sm d-flex align-items-center">
            <i class="fa fa-share-square me-2"></i> Share
        </button>
    </div>
</div>

<!-- Toast Notification -->
<div id="toastNotification" class="toast align-items-center text-bg-dark border-0 position-fixed bottom-0 end-0 m-3" style="z-index: 1050; display: none;">
    <div class="d-flex">
        <div class="toast-body">
            Link copied to clipboard!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
@endsection

<style>
    .volume-slider {
        accent-color: #28a745;
        background: linear-gradient(to right, #28a745, #6c757d);
        border-radius: 5px;
    }

    .volume-slider::-webkit-slider-thumb {
        background-color: #fff;
        border: 1px solid #28a745;
        border-radius: 50%;
        width: 15px;
        height: 15px;
        cursor: pointer;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const audioPlayer = document.getElementById('audioPlayer');
        const playPauseBtn = document.getElementById('playPauseBtn');
        const prevTrackBtn = document.getElementById('prevTrackBtn');
        const nextTrackBtn = document.getElementById('nextTrackBtn');
        const progressBar = document.getElementById('progressBar');
        const currentTimeEl = document.getElementById('currentTime');
        const durationEl = document.getElementById('duration');
        const volumeSlider = document.getElementById('volumeSlider');
        const volumeIcon = document.getElementById('volumeIcon');
        const shareButton = document.getElementById('shareButton');
        const toastNotification = document.getElementById('toastNotification');
        const songId = "{{ $song->id }}";
        const shareLink = `${window.location.origin}/songs/${songId}`;

        function togglePlayPause() {
            const playIcon = playPauseBtn.querySelector('i');
            if (audioPlayer.paused || audioPlayer.ended) {
                audioPlayer.play();
                playIcon.className = 'fa fa-pause';
            } else {
                audioPlayer.pause();
                playIcon.className = 'fa fa-play';
            }
        }

        function prevTrack() {
            console.log('Previous track clicked');
            // Add logic for playing the previous track
        }

        function nextTrack() {
            console.log('Next track clicked');
            // Add logic for playing the next track
        }

        function updateProgress() {
            if (audioPlayer.duration) {
                const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
                progressBar.style.width = `${progress}%`;
                currentTimeEl.textContent = formatTime(audioPlayer.currentTime);
            }
        }

        function setDuration() {
            durationEl.textContent = formatTime(audioPlayer.duration || 0);
        }

        function adjustVolume() {
            audioPlayer.volume = volumeSlider.value;
            if (audioPlayer.volume === 0) {
                volumeIcon.className = 'fa fa-volume-mute';
            } else if (audioPlayer.volume < 0.5) {
                volumeIcon.className = 'fa fa-volume-down';
            } else {
                volumeIcon.className = 'fa fa-volume-up';
            }
        }

        function showToast(message) {
            const toastBody = toastNotification.querySelector('.toast-body');
            toastBody.textContent = message;

            toastNotification.style.display = 'block';
            setTimeout(() => {
                toastNotification.style.display = 'none';
            }, 3000);
        }

        shareButton.addEventListener('click', () => {
            navigator.clipboard.writeText(shareLink)
                .then(() => showToast('Link copied to clipboard!'))
                .catch(() => showToast('Failed to copy link!'));
        });

        playPauseBtn.addEventListener('click', togglePlayPause);
        prevTrackBtn.addEventListener('click', prevTrack);
        nextTrackBtn.addEventListener('click', nextTrack);
        audioPlayer.addEventListener('timeupdate', updateProgress);
        audioPlayer.addEventListener('loadedmetadata', setDuration);
        volumeSlider.addEventListener('input', adjustVolume);
    });
</script>
