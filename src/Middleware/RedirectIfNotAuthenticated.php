<?php namespace Insanetlabs\IntelliTrace\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{

    /**
     * Redirect to login page if the user is not authenticated
     *
     * @param Request $request
     * @param Closure $next
     * @return void
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('intellitrace')->check()) {
            return redirect('/intellitrace/login');
        }

        return $next($request);
    }
}