<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class  CompleteSubscriptionMiddleware
{
    public function handle($request, Closure $next)
    {

        $user =  $request->user();

        if (!$user->hasIncompletePayment('default')) {
            return $next($request);
        }

        return response(405, 403);
    }
}
