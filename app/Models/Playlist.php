<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    public static function findByName(string $name)
    {
        return static::query()->where('name', '=', $name)->first();
    }


}
