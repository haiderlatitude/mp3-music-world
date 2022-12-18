<?php

namespace App\Http\Controllers;

use App\DataTables\PlaylistDataTable;
use App\Http\Requests\StorePlaylistRequest;
use App\Http\Requests\UpdatePlaylistRequest;
use Illuminate\Http\Request;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PlaylistDataTable $dataTable)
    {
        return $dataTable->render('playlist.index');
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
     * @param \Illuminate\Http\Request;
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $playlist = new Playlist();
            $playlist->name = $request->name;
            $playlist->user_id = auth()->id();
            $playlist->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Playlist has been added successfully!'
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'type' => 'error',
                'message' => 'Some error occurred. Please try again later!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Playlist $playlist
     * @return \Illuminate\Http\Response
     */
    public function show(Playlist $playlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Playlist $playlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePlaylistRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
        $playlist = Playlist::query()->find($id);
        $playlist->name = $request->name;
        $playlist->save();
        return response([
            'type' => 'success',
            'message' => 'Playlist Name edited successfully.'
        ]);
        }
        catch(\Exception $e){
            return response([
                'type' => 'error',
                'message' => 'Could not update playlist name.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Playlist $playlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   try{
            $playlist = Playlist::query()->find($id);
            $playlist->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Deleted successfully'
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'type' => 'error',
                'message' => 'Some error occurred during the deletion of Playlist!'
            ]);
        }
    }
}
