<?php namespace Insanetlabs\IntelliTrace\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Insanetlabs\IntelliTrace\Models\IntelliTraceUser;

class RedirectIfNotRegistered
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
        if (IntelliTraceUser::count() <= 0) {
            return redirect('/intellitrace/register');
        }

        return $next($request);
    }
}