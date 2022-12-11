<?php

namespace App\Http\Controllers;

use App\DataTables\MusicDataTable;
use App\Http\Requests\StoreMusicRequest;
use App\Http\Requests\UpdateMusicRequest;
use App\Models\Music;
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
        return  $dataTable->render('dashboard');
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMusicRequest $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMusicRequest $request, Music $music)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Music $music
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music $music)
    {
        //
    }

    public function playSong($id){
        $song = Music::find($id);
        $filePath = $song['file_path'];
        return view('dashboard', compact('filePath'));
    }
}