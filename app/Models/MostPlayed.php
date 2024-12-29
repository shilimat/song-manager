<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MostPlayed extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'song_id',
        'user_id',
        'artist_id',
        'album_id',
        'play_count',
        'last_played_at',
    ];

    /**
     * Get the song associated with the play count.
     */
    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    /**
     * Get the user associated with the play count.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the artist associated with the play count.
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Get the album associated with the play count.
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public static function getTopSongsByTotalPlayCount($artistId)
    {
        // Fetch songs, group by song_id, sum the play_count, join with songs table
        $topSongs = DB::table('most_playeds')
            ->select('song_id', DB::raw('SUM(play_count) as total_play_count'))
            ->where('artist_id', $artistId)
            ->groupBy('song_id')  // Group by song_id to sum play counts
            ->orderByDesc('song_id')  // Sort by song_id in descending order
            ->get();

        // Now join with Song table to get the details for each song
        $topSongsWithDetails = $topSongs->map(function ($mostPlayed) {
            // Fetch the song details using the song_id
            $song = Song::with(['artist', 'album', 'genre'])->find($mostPlayed->song_id);

            // Attach total play count to the song details
            $song->total_play_count = $mostPlayed->total_play_count;

            return $song;
        });

        return $topSongsWithDetails;
    }
}
