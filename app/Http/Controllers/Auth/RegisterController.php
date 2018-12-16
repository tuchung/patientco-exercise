<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Users;
class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try{
        //add code to check for existing email
        
            $user = new Users;
            $user->name = $request->input('name');
            $user->dob = $request->input('dob');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }catch(\Exception $e){
            return response($e);
        }
        return response($request, 200);
    }

}
