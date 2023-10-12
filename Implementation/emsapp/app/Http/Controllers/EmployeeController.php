<?php
//Created by Nikola Šubarić 2020/0271
//Updated by Ivan Šobić 2020/0072

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeModel;

class EmployeeController extends Controller
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
    * Funkcija za prikaz svih zaposlenih.
    * 
    * @return view
    */
    public function allEmployees()
    {
        $employees = EmployeeModel::all();

        return view("employeesOverview", ["employees" => $employees]);
    }

    /**
    * Funkcija za prikaz jednog zaposlenog.
    *
    * @param int $idemployee id zaposlenog
    * 
    * @return view
    */
    public function viewEmployee($idemployee)
    {
        $employee = EmployeeModel::find($idemployee);

        return view("employee", ["employee" => $employee]);
    }
}
