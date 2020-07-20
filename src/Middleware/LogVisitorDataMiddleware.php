<?php namespace Insanetlabs\IntelliTrace\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Insanetlabs\IntelliTrace\Models\Visitor;
use Illuminate\Support\Str;

class LogVisitorDataMiddleware
{

    /**
     * Save the data in the database
     *
     * @param Request $request
     * @param Closure $next
     * @return void
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Str::contains($request->url(), ['intellitrace'])) {
        //Save the visitor in the database
            $visitor = new Visitor();
            $visitor->ip = $request->getClientIp();
            $visitor->date = Carbon::now()->format('Y-m-d');

        // GET IP data from API
            $visitor->fillDataFromIP();

            $visitor->save();
        }

        return $next($request);
    }
}