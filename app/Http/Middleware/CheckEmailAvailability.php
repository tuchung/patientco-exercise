<?php

namespace App\Http\Middleware;

use Closure;
use App\Users;

class CheckEmailAvailability
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $model = Users::where("email", $request->input('email'))->first();
        if($model !== null){
            return response('This email have been taken. please try again.', 500); 
        }
        return $next($request);
    }
}
