<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class HasPermission
{
    /**
     * Handle an incoming request.
     * Réfuser l'accès aux routes aux personnes qui n'y ont pas accès
     * Must be used after auth middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (Route::is('*.index') || Route::is('*.show')) {
            if (! $user->can('afficher donnees')) {
                return abort(401);
            }
        }

        if (Route::is('*.create') || Route::is('*.store')) {
            if (! $user->can('ajouter donnees')) {
                return abort(401);
            }
        }

        if (Route::is('*.edit') || Route::is('*.update')) {
            if (! $user->can('modifier donnees')) {
                return abort(401);
            }
        }

        return $next($request);
    }
}
