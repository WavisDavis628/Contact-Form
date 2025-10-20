<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuth
{
    public function handle(Request $request, Closure $next)
    {
        $user = env('ADMIN_USER');
        $pass = env('ADMIN_PASS');

        // If creds aren't set, leave the list open
        if (! $user || ! $pass) {
            return $next($request);
        }

        if ($request->getUser() === $user && $request->getPassword() === $pass) {
            return $next($request);
        }

        return response('Unauthorized', 401)->header('WWW-Authenticate', 'Basic realm="Submissions"');
    }
}
