<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class weihu
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
         $configtitle = DB::table('config')->get();
        if(($configtitle['0']->open)=='y')
            {   
                return redirect('/error/weihu');
            }else{
               return $next($request);
            }
    }
}
