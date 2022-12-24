<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\MP3Mail;

class EmailController extends Controller
{
    public function send(Request $request){
        try{
            $email = User::where('email', $request->email)->first();

            Mail::to($email['email'])->send(new MP3Mail());
            return redirect()->intended('forgot-password')
            ->with('message', 'Please check your Email for Password Reset link');
        }

        catch(\Exception $e){
            return redirect('forgot-password')
            ->with('message', 'Provided Email Address does not exist');
        }
    }
}
