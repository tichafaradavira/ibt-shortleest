<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class HasPaymentMethodMiddleware
{
    public function handle($request, Closure $next)
    {

        $user =  $request->user();
        $today = Carbon::now();

        if ($user->hasPaymentMethod() || ($today < $user->trial_ends_at) ) {
            return $next($request);
        }

        return response(403, 403);
    }
}
