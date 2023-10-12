<?php
// Created by Nikola Šubarić 2020/0271
namespace App\Http\Middleware;

use App\Models\MeetingModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingMiddleware
{
    /**
     * Obradjuje nadolazeci zahtev od strane korisnika nad meeting-om (azuriranje). Propusta dalje samo one zahteve koji su potekli od korisnika koji
     * je kreator samog meeting-a.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if($user->idrole == 1) return $next($request);
        $idmeeting = $request->id;
        $meetings = MeetingModel::where('idemployee', $user->idemployee)->get();
        foreach($meetings as $meeting){
            if ($meeting->idmeeting == $idmeeting)
                return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
