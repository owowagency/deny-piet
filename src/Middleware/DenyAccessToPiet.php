<?php

namespace OwowAgency\DenyPiet\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class DenyAccessToPiet
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
        if (Auth::check() && $this->userIsPiet(Auth::user())) {
            return abort(403, trans('deny-piet::general.not_allowed'));
        }

        return $next($request);
    }

    /**
     * Determine if the current authenticated user is Pieter-Jan.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return bool
     */
    private function userIsPiet(Authenticatable $user): bool
    {
        return in_array($user->email, config('deny-piet.emails'));
    }
}
