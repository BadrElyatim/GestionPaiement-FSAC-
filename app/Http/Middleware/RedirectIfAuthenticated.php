<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Gate::allows('is_responsable')) {
                    return redirect()->route('responsable.filieres');
                }

                if (Gate::allows('viewany-etudiant')) {
                    return redirect(RouteServiceProvider::HOME);
                }

                return redirect()->route('filiere.etudiants', auth()->user()->filieres->sortByDesc('annee_universitaire')->first()->id);
            }
        }

        return $next($request);
    }
}
