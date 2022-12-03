<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use Illuminate\Http\Request;
use App\DataTables\ArtistDataTable;
use App\Models\Artist;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArtistDataTable $dataTable)
    {
        return $dataTable -> render('admin.artists.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreArtistRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try{
        $artist = new Artist();
        $artist->name = $request->all()['artist-name'];
        $artist->save();

        return redirect()->intended('admin/artists/create')
        ->with('message', 'Artist added successfully.');
        }

        catch(Exception $e){
            return redirect()->intended('admin/artists/create')
            ->with('message', 'Artist added successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateArtistRequest $request
     * @param \App\Models\Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtistRequest $request, Artist $artist)
    {
        try{
            $artist->name = $request->all()['name'];
            $artist->save();

            return response()->json([
                'type' => 'success',
                'message' => 'Artist has been updated successfully'
            ]);
        }

        catch(Exception $e){
            return response()->json([
                'type' => 'error',
                'message' => 'Oops! Something bad is going on :('
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Artist $artist
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Artist $artist)
    {
        try{
        $artist->delete();
        return response()->json(
            [
                'type' => 'success',
                'message' => 'artist deleted successfully.'
            ]);
        }
        
        catch(Exception $e){
            return response()->json(
                [
                    'type' => 'error',
                    'message' => "Can't delete Artist, because it has a song"
                ]);
        }

    }
}
