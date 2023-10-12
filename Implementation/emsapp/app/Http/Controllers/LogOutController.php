<?php
//Created by Nikola Šubarić 2020/0271
//Updated by Uros Kozic 2020/0267
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogOutController extends Controller
{
    /**
    * Kreiranje nove instance sa posebnim middleware-om. Samo ulogovani korisnici mogu da koriste metode ovog kontrolera.
    * 
    * @return void
    */
    function __construct() {
        $this->middleware('auth');
    }

    /**
     * Funkcija za odjavu sa sajta
     * 
     *  korisnik pozivom ove funkcije vise nije ulogovan
     * 
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */

    public function logout(){
        auth()->logout();
        return redirect()->route('login');

    }
}
