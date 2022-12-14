<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_music', function (Blueprint $table) {
            $table->unsignedBigInteger('playlist_id');
            $table->unsignedBigInteger('music_id');
            $table->foreign('playlist_id')->references('id')->on('playlists')
                ->cascadeOnDelete();
            $table->foreign('music_id')->references('id')->on('music')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlist_music');
    }
};
