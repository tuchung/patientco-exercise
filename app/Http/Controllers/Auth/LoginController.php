<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Users;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        try{
        //add code to check for existing email
        
            $model = Users::where('email',$request->input('email'))
            ->first();

            if($model === null || !Hash::check($request->input('password'),$model->password)){
                return response('Given email and password does not match any records. Please try again.', 500);
            }
            
            session(['email' => $model->email]);
            session(['user_id' => $model->id]);

        }catch(\Exception $e){
            return response($e);
        }
        return response('success', 200);
    }

    public function logout(Request $request)
    {
        try{
        //add code to check for existing email
        
        $request->session()->flush();

        }catch(\Exception $e){
            return response($e);
        }
        return response('success', 200);
    }

}
