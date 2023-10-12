<?php
//Created by Nikola Šubarić 2020/0271 
//Created by Uros Kozic 2020/0271 
namespace App\Http\Controllers;

use App\Models\RoleModel;
use App\Models\LogModel;
use Illuminate\Http\Request;
/**
* LogController – klasa za logovanje registrovanog korisnika
*
*/
class LogController extends Controller
{
    /**
    * Kreiranje nove instance sa posebnim middleware-om. Samo korisnici koji nisu ulogovani mogu da koriste metode ovog kontrolera.
    * 
    * @return void
    */
    function __construct() {
        $this->middleware('guest');
    }
    /**
     * Funkcija za preusmeravanje na stranicu za logovanje.
     * 
     * @return view
     */
    public function login(){
        return view('login');
    }
    /**
     * Funkcija za proveru uspesnosti logovanja
     * 
     * ako je uspesno logovanje onda nas prusmerava na sajt
     * 
     * u slucaju neuspeha vraca nas na stranicu odakle smo dosli(stranica 'login') uz dodatne prosledjene atribute
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */

    public function loginSubmit(Request $request){

        $this->validate($request, [
            'email' => 'required|min:1' ,
            'password' =>'required|min:1'
        ],[
            'required' => 'Polje :attribute je obavezno',
        ]);

        if(!auth()->attempt( $request->only('email','password'))){
                return back()->with('status', 'Losi kredencijali');
                //return redirect('/');
        }

        return redirect()->route('allEmployees');


    }
    /**
     * Funkcija za preusmeravanje na indexnu stranicu.
     * 
     * @return view
     */
    public function index(){ //za testiranje
        return view('index');
    }

    /**
     * Funkcija za preusmeravanje na stranicu za templejta.
     * 
     * @return view
     */

    public function templateDefined(){
        
        return view('templateDefined');
    }

}
