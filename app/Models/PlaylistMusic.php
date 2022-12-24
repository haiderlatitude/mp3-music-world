<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistMusic extends Model
{
    use HasFactory;

    public static function findOrCreate(int $musicId, int $playlistId)
    {
        $obj = static::query()->where('music_id', '=', $musicId)
            ->where('playlist_id', '=', $playlistId)
            ->first();
        return $obj ?: new static;
    }
}
