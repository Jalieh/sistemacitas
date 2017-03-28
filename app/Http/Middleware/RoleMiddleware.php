<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleMiddleware
{

    public function handle($request, Closure $next, $role, $permission=null)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        if (!$request->user()->hasRole($role)) {
            abort(403, 'Whoops');
        }
        if ($permission != null){
            if (!$request->user()->can($permission)) {
                abort(403, 'Whoops');
            }
        }

        return $next($request);
    }
}
