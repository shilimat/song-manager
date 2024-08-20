<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'release_date',
        'cover_image',
        'description',
        'artist_id' // Add this line
    ];

    // Relationships
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class); // Define the relationship to Artist
    }
}
