<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- Logo aligned to the left -->
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'song_crud') }}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <!-- Menu options centered -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('songs.index') ? 'active' : '' }}" href="{{ route('songs.index') }}">Songs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('artists.index') ? 'active' : '' }}" href="{{ route('artists.index') }}">Artists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('genres.index') ? 'active' : '' }}" href="{{ route('genres.index') }}">Genres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('albums.index') ? 'active' : '' }}" href="{{ route('albums.index') }}">Albums</a>
                </li>
            </ul>
        </div>

        <div class="navbar-collapse collapse justify-content-end">
            <ul class="navbar-nav">
                @auth
                <!-- User avatar icon and name with dropdown menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="border-radius: 0.5rem; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <!-- Login and Register buttons when not authenticated -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
