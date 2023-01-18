<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\DataTables\ArtistDataTable;
use Illuminate\Support\Str;
use App\Models\Artist;
use ErrorException;

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
    public function store(StoreArtistRequest $request)
    {
        try{
            $artist = Artist::where('name', $request->name)->first();
            if(Str::lower($artist->name) === Str::lower($request->name))
                return redirect('admin/artists/create')
                ->with('message', 'Artist already exists!');
        }

        catch(ErrorException $e){
            $artist = new Artist();
            $artist->name = $request->name;
            $artist->save();

            return redirect('admin/artists/create')
            ->with('message', 'Artist added successfully');
        }

        catch(\Exception $e){
            return redirect('admin/artists/create')
            ->with('message', 'Could not add new Artist. Please try again later!');
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateArtistRequest $request, Artist $artist)
    {
        try{
            $exists = Artist::where('name', $request->name)->first();
            if(Str::lower($exists->name) === Str::lower($request->name))
                return response()->json([
                    'type' => 'info',
                    'message' => 'Artist already exists!'
                ]);
            }

            catch(ErrorException $e){
            $artist->name = $request->name;
            $artist->save();
            unset($exists);

            return response()->json([
                'type' => 'success',
                'message' => 'Artist has been updated successfully'
            ]);
        }

        catch(\Exception $e){
            return response()->json([
                'type' => 'error',
                'message' => 'Could not update Artist. Please try again later!'
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
                    'message' => 'Artist deleted successfully.'
                ]);
        }

        catch(\Exception $e){
            return response()->json(
                [
                    'type' => 'error',
                    'message' => "Can't delete Artist, they might have a song."
                ]);
        }

    }
}
