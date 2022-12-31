<?php

namespace App\Http\Controllers;

use App\DataTables\SongsListAdminDataTable;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminSongsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SongsListAdminDataTable $dataTable)
    {
        return $dataTable->render('admin.songs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $artists = Artist::all();
        $categories = Category::all();
        return view('admin.songs.create', compact('artists', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $music = new  Music();
        $music->name = $request->all()['song-name'];
        $music->artist_id = $request->all()['artist-id'];
        $music->category_id = $request->all()['category-id'];
        $temp = $request->all()['song'];
        $file = explode('@', $temp);

        Storage::move('songs/temp/' . $file[0] . '/' . $file[1],
            'songs/' . $file[0] . '/' . $file[1]);
        $music->file_path = $file[0] . '/' . $file[1];
        $music->save();
        Storage::deleteDirectory('songs/temp/' . $file[0]);

        return redirect()->intended('admin/songs/create')
            ->with('message', 'Song uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $song = Music::query()->find($id);
        $song->name = $request->all()['name'];
        $song->artist_id = $request->all()['artist_id'];
        $song->save();

        return response()->json(
            [
                'type' => 'success',
                'message' => 'Song updated Successfully!',
            ]
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $music = Music::query()->find($id);
        $filePath = explode("/", $music['file_path']);
        $directory = $filePath[0];
        Storage::deleteDirectory('songs/'.$directory);
        $music->delete();

        return response()->json(
            [
                'type' => 'success',
                'message' => 'Song has been deleted successfully',
            ]
        );
    }


    public function upload(Request $request){
        if ($request->hasFile('song')){
            $file = $request->file('song');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid();
            $file->storeAs('songs/temp/' . $folder, $fileName);

            return $folder . '@' . $fileName;
        }

        return '';
    }

    public function clearTemp(){
        Storage::deleteDirectory('songs/temp');
        return redirect()->intended('admin/songs/create')
            ->with('message', 'Temporary Files Deleted');
    }


    public function getArtists(){
        return Artist::all()->toJson();
    }
}
