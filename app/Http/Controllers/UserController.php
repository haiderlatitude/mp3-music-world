<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function updateProfile(Request $request, $id){
        try{
            $user = User::query()->find($id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();
            redirect()->intended('profile');
            return response()->json([
                'type' => 'success',
                'message' => 'Profile has been updated successfully!'
            ]);
        }
        catch(\Exception $e){
            redirect()->intended('profile');
            return reponse()->json([
                'type' => 'error',
                'message' => 'Could not update your profile information. Please try again later!'
            ]);
        }
    }

    public function updatePassword(Request $request, $id){
        try{
            $user = User::query()->find($id);
            $user->password = Hash::make($request->password);
            $user->save();
            redirect()->intended('profile');
            return response()->json([
                'type' => 'success',
                'message' => "Password has been updated successfully!"
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'type' => 'error',
                'message' => "Some error occurred, please try again later!"
            ]); 
        }
    }

    public function resetPassword(Request $request, $email){
        try{
            $user = User::where('email', $email)->first();

            $user->password = Hash::make($request->password);
            redirect('dashboard');
            return response()->json([
                'type' => 'success',
                'message' => 'Password has been reset successfully!'
            ]); 
        }
        catch(\Exception $e){
            return response()->json([
                'type' => 'error',
                'message' => 'Provided Email Address does not exist!'
            ]);
        }
    }
}
