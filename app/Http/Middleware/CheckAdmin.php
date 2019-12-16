<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        // authenticate if the user is Admin (user_id == 1)
        $id = Auth::id();
        if ($id != 1) {
          return redirect('/')->with('error', 'Unauthorized User');
        }
        return $next($request);
    }
}
