<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class LogLastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->last_activity < Carbon::now()->subMinutes(1)->format('Y-m-d H:i:s')) {
            $user = Auth::user();
            $user->last_activity = Carbon::now();
            $user->timestamps = false;
            $user->save();
        }
        return $next($request);
    }
}
