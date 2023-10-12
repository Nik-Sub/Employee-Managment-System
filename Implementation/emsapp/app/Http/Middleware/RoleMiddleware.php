<?php
// Created by Nikola Šubarić 2020/0271

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Obradjuje nadolazeci zahtev. Propusta dalje samo one zahteve koji dolaze od korisnika ciji je idrole jednak
     * onom koji je prosledjen kao parametar samom middleware-u.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();
        if (!$user || $user->idrole != $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
