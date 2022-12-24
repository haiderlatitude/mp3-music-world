<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function playlistSongs()
    {
        return $this->belongsToMany(
            Playlist::class,
            'playlist_music',
        );
    }

    public function addToPlaylist(int $playlistId): bool
    {
        $item = PlaylistMusic::findOrCreate($this->id, $playlistId);
        $item->music_id = $this->id;
        $item->playlist_id = $playlistId;
        $item->save();
        return true;
    }
}
