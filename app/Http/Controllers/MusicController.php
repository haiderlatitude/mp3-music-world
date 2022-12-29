<?php

namespace App\Http\Controllers;

use App\DataTables\MusicDataTable;
use App\Http\Requests\StoreMusicRequest;
use App\Http\Requests\UpdateMusicRequest;
use App\Models\Category;
use App\Models\Music;
use App\Models\Playlist;
use function Termwind\render;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MusicDataTable $dataTable)
    {
        if (request()->has('p') && (request('p') != null)){
            $dataTable->setPlaylist(request('p'));
        }

        $categories = Category::all();
        return  $dataTable->render('dashboard', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreMusicRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMusicRequest $request)
    {
//        dd($request->all());
        $music = Music::query()->find($request->json()->all()['musicId']);
        $music->playlistSongs()->syncWithoutDetaching(request()->json()->all()['playlistId']);

        return response()->json(
            [
                'type' => 'success',
                'message' => 'Song added to playlist',
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Music $music
     * @return \Illuminate\Http\Response
     */
    public function show(Music $music)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Music $music
     * @return \Illuminate\Http\Response
     */
    public function edit(Music $music)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateMusicRequest $request
     * @param \App\Models\Music $music
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMusicRequest $request)
    {
        $music = Music::query()->find($request->json()->all()['musicId']);
        $music->playlistSongs()->detach(
            Playlist::findByName(
                request()->json()->all()['playlist']
            )
        );

        return response()->json(
            [
                'type' => 'success',
                'message' => 'Song removed from playlist',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Music $music
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music $music)
    {
        dd($music);
    }
}
