<?php

namespace App\Http\Middleware;

use Closure;

class AuthToken
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
      
        return $next($request);

        /*
            PERMISSION
        */
        
        // $auth = $request->header('Authorization');
        // if($auth == sha1('bravi')){
        // 	return $next($request);
        // }
       
    }
}
