<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\DataTables\CategoryDataTable;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable -> render('admin.category.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::where('name', '=', $request->name)->first();
        
        try{
            if(Str::lower($category->name) === Str::lower($request->name)){
                return response()->json([
                    'type' => 'info',
                    'message' => 'Category already exists'
                ]);
            }
            else{
                $category->name = $request->name;
                $category->save();
                return response()->json([
                    'type' => 'success',
                    'message' => 'New category has been added.'
                ]);
            }
        }

        catch(\Exception $e){
            return response()->json([
                'type' => 'error',
                'message' => 'Could not add new category!'
            ]);
        }
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $category = Category::find($id);
            $category->name = $request->name;
            $category->save();

            return response()->json([
                'type' => 'success',
                'message' => 'Category name has been updated.'
            ]);
        }

        catch(\Exception $e){
            return response()->json([
                'type' => 'error',
                'message' => 'Some error occurred! Please try again later.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Category::find($id)->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Category has been deleted successfully.'
            ]);
        }

        catch(\Exception $e){
            return response()->json([
                'type' => 'error',
                'message' => 'Category could not be deleted.'
            ]);
        }
    }
}
