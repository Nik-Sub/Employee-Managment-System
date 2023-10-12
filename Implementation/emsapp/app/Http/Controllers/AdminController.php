<?php
//Created by Nikola Šubarić 2020/0271
//Updated by Uros Kozic 2020/0267

namespace App\Http\Controllers;

use App\Models\AttendanceModel;
use App\Models\EmployeeModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

/**
 * AdminController - klasa za rad sa nalozima (kreiranje, azuriranje i brisanje naloga).
 * Klasa za pravljenje rola.
 * @version 1.0
 */

class AdminController extends Controller
{

    /**
    * Kreiranje nove instance sa posebnim middleware-om. Prosledjivanje parametra 1, jer samo admin moze da izvrsava metode ovog controller-a.
    * 
    * @return void
    */
    public function __construct()
    {
        $this->middleware('role:1');
    }

    /**
     * Funkcija za preusmeravanje na stranicu za pravljenje naloga.
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createAccount(){
        $roles = RoleModel::get();
        return view("createAccount", ["roles" => $roles]);

    }

    /**
     * Funkcija za preusmeravanje na stranicu za azuriranje naloga
     * 
     * @param int $id naloga
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updateAccount($id){

        $employees = EmployeeModel::where("idemployee", $id)->get();
        
        $roles = RoleModel::get();

        return view("updateAccount", ["employee" => $employees[0], "roles" => $roles]);

    }


    /**
     * Funkcija za submit-ovanje podataka koji su potrebni da bi se napravio nalog.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function createAccountSubmit(Request $request){
        //dd( request()->all() );

        // move picture to the public/img folder so client browser will have access to it
        $image = $request->file('picture');

    
        // it means that image is too big so it was not uploaded
        if (!$image->getSize()){
            return back()->with("image", "Image is bigger then 2048 KB");
        }

        $fileName = $image->getClientOriginalName(); // Retrieve the original file name

        $image->move(public_path('img'), $fileName); // Move the file to the desired location within the public folder


        $employee = EmployeeModel::where("email", $request->email)->get();
        if ($employee->count() != 0){
            return back()->with("status", "Email exists!");
        }

        // get returns collection
        $role = RoleModel::where("name", "$request->role")->get();

        EmployeeModel::create([
            'firstName' => $request->name,
            'lastName' => $request->lastName,
            'birthday' => $request->birthday,
            'department' => $request->department,
            'email' => $request->email,
            'password' => $request->password,
            'idrole' => $role[0]->idrole,
            'picture' => $fileName
        ]);

        return redirect()->route("createAccount");
    }

    /**
     * Funkcija za submit-ovanje podataka koji su izmenjeni radi azuriranja naloga.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function updateAccountSubmit(Request $request){
        //dd( request()->all() );
        $idemployee = $request->idemployee;
        // get returns collection
        $employees = EmployeeModel::where("idemployee", $idemployee)->get();
        $employee = $employees[0];

        $roles = RoleModel::where("name", $request->role)->get();
        $role = $roles[0];

        // changed email
        if ($employee->email != $request->email){
            $checkEmployee = EmployeeModel::where("email", $request->email)->get();
            if ($checkEmployee->count() != 0){
                return back()->with("status", "Email exists!");
            }
            EmployeeModel::where('idemployee',$idemployee)->update(['email'=>$request->email]);
        }

        if ($employee->firstName != $request->name){
            EmployeeModel::where('idemployee',$idemployee)->update(['firstName'=>$request->name]);
        }
        if ($employee->lastName != $request->lastName){
            EmployeeModel::where('idemployee',$idemployee)->update(['lastName'=>$request->lastName]);
        }
        if ($employee->birthday != $request->birthday){
            EmployeeModel::where('idemployee',$idemployee)->update(['birthday'=>$request->birthday]);
        }
        if ($employee->department != $request->department){
            EmployeeModel::where('idemployee',$idemployee)->update(['department'=>$request->department]);
        }
        if ($employee->password != $request->password && $request->password != null){
            EmployeeModel::where('idemployee',$idemployee)->update(['password'=>$request->password]);
        }
        if ($employee->idrole != $role->idrole){
            EmployeeModel::where('idemployee',$idemployee)->update(['idrole'=>$role->idrole]);
        }


        // move picture to the public/img folder so client browser will have access to it
        $image = $request->file('picture');
        if ($image != null){
            // it means that image is too big so it was not uploaded
            if (!$image->getSize()){
                return back()->with("image", "Image is bigger then 2048 KB");
            }

            $fileName = $image->getClientOriginalName(); // Retrieve the original file name
            if ($employee->picture != $fileName){

                $image->move(public_path('img'), $fileName); // Move the file to the desired location within the public folder
                EmployeeModel::where('idemployee',$idemployee)->update(['picture'=>$fileName]);
            }
        }

        return redirect()->route("allEmployees");
    }


    /**
     * Funkcija za brisanje naloga.
     * 
     * @param int $id naloga
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function deleteAccount($id){
        
        $meetings = EmployeeModel::find($id)->myMeetings();
        if ($meetings->count() != 0){
            return back()->with("nodelete", "Delete is impossible because this employee has meetings.");
        }

        $path = public_path('img/'.EmployeeModel::where("idemployee", $id)->get()[0]->picture);

        if (File::exists($path)) {
            File::delete($path);
        }

        EmployeeModel::where("idemployee", $id)->delete();

        

        if ($id == auth()->user()->idemployee){
            return redirect()->route("logout");
        }

        return redirect()->route("allEmployees");
    }

    /**
    * Funkcija za preusmeravanje na stranicu za pregled rola.
    * 
    * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function roleOverview(){
        $roles = RoleModel::all();
        return view('roleOverview',['roles' => $roles]);
    }

    /**
     * Funkcija za preusmeravanje na stranicu za pravljenje rola.
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createRole(){

        return view('createRole');

    }

     /**
     * Funkcija za submit-ovanje podataka koji su potrebni da bi se napravila korisnicka uloga (rola).
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function createRoleSubmited(Request $request){

        $this->validate($request,[
            'name' => 'required'
        ]);

        $role = RoleModel::create([
            
            'name' => $request->name
        ]);

        return redirect()->route('roleOverview');
        // return redirect()->route('roleOverview');
    }
}
