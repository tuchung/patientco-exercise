<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Users;
class AuthenticateController extends Controller
{
    public function checkLogin(Request $request)
    {
        //use middleware to authenticate
        return response($request, 200);
    }

}
