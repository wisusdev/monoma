<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (! $request->user() || ! $request->user()->hasRole($role)) {
            throw new AccessDeniedHttpException('This action is unauthorized.');
        }

        return $next($request);
    }
}
