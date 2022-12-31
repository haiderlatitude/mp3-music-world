<?php

namespace App\Http\Controllers;

use App\DataTables\PlaylistDataTable;
use App\Models\Playlist;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request;
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $playlist = new Playlist();
            $playlist->name = $request->name;
            $playlist->user_id = auth()->id();
            $playlist->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Playlist has been added successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => 'Some error occurred. Please try again later!'
            ]);
        }
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
        try {
            $playlist = Playlist::find($id);
            $playlist->name = $request->name;
            $playlist->save();
            return response([
                'type' => 'success',
                'message' => 'Playlist Name edited successfully.'
            ]);
        } catch (\Exception $e) {
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            Playlist::find($id)->delete();
            return response([
                'type' => 'success',
                'message' => 'Deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response([
                'type' => 'error',
                'message' => 'Some error occurred during the deletion of Playlist!'
            ]);
        }
    }

    public function getPlaylists()
    {
        return Playlist::where('user_id', auth()->id())->get();
    }
}
