<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MostPlayed extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'most_played';

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
}
