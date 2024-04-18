<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole($role)) {
            \Log::warning('Попытка зайти в админку без прав', [
                'time' => now(),
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'user' => $user
            ]);
            abort(404);
        }
        return $next($request);
    }
}
