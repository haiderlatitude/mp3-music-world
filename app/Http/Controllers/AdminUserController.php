<?php

namespace App\Http\Controllers;

use App\DataTables\UsersListDataTable;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersListDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return response([
                'type' => 'success',
                'message' => 'User details updated successfully!'
            ]);
        }
        catch(QueryException $e){
            return response([
                'type' => 'info',
                'message' => 'This email address already exists!'
            ]);
        }

        catch(\Exception $e){
            return response([
                'type' => 'error',
                'message' => 'Could not update credentials!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            User::find($id)->delete();
            return response([
                'type' => 'success',
                'message' => 'User deleted!'
            ]);
        }
        catch(\Exception $e){
            return response([
                'type' => 'error',
                'message' => 'Could not delete the user account!'
            ]);
        }
    }
}
