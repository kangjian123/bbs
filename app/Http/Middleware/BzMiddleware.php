<?php

namespace App\Http\Middleware;

use Closure;

class BzMiddleware
{
    /**
     * 版主登录的中间件.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        session_start();
        if(!empty($_SESSION['username'])){
                return $next($request);
            }else{
                return redirect('/adlogin/login');
            }
    }
}
