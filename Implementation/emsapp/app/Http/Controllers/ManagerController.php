<?php
//Created by Nikola Šubarić 2020/0271
//Created by Boris Martinovic 2020/0582

namespace App\Http\Controllers;

use App\Models\AttendanceModel;
use App\Models\EmployeeModel;
use App\Models\MeetingModel;
use Carbon\Carbon;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ManagerController extends Controller
{
    /**
     * Kreiranje nove instance sa posebnim middleware-om. Middleware-om adminOrManager se omogucava koriscenje metoda ovog kontrolera samo
     * ulogovanim korisnicima koji su admini ili menadzeri. Middleware-om meeting se izvrsava dodatna provera da li sam miting pripada
     * ulogovanom korisniku, pa ako je to slucaj, onda je i dozvoljeno koriscenje pojedinih metoda (updateMeeting, updateAttendence, deleteMeeting)
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('adminOrManager');
        $this->middleware('meeting')->only('updateMeeting');
        $this->middleware('meeting')->only('updateAttendance');
        $this->middleware('meeting')->only('deleteMeeting');
    }

    /**
     * Funkcija za preusmeravanje na stranicu za pravljenje sastanka.
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */

    public function createMeeting(){

        $manager = EmployeeModel::find(auth()->user()->idemployee);
        return view("createMeeting", ['manager' => $manager]);

    }

    /**
     * Funkcija za preusmeravanje na stranicu za azuriranje sastanka
     * 
     * @param int $id sastanka
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updateMeeting($id){

        $meeting = MeetingModel::where('idmeeting', $id)->get();
        $manager = EmployeeModel::where('idemployee', $meeting[0]->idemployee)->get();

        return view("updateMeeting", ['meeting' => $meeting[0], 'manager' => $manager[0]]);
        
    }

    /**
     * Funkcija za preusmeravanje na stranicu za azuriranje prisustva na sastanku
     * 
     * @param int $id sastanka
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updateAttendance($id){

        $meeting = MeetingModel::where('idmeeting', $id)->get();
        $manager = EmployeeModel::where('idemployee', $meeting[0]->idemployee)->get();

        return view("updateAttendance", ['meeting' => $meeting[0], 'manager' => $manager[0]]);

    }

    /**
     * Funkcija za submit-ovanje podataka koji su potrebni da bi se napravio sastanak.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function createMeetingSubmit(Request $request){

        $timeFrom = new Carbon($request->meetdate);
        $timeFrom->hour = explode(":", $request->timeFrom)[0];
        $timeFrom->minute = explode(":", $request->timeFrom)[1];

        $timeTo = new Carbon($request->meetdate);
        $timeTo->hour = explode(":", $request->timeTo)[0];
        $timeTo->minute = explode(":", $request->timeTo)[1];

        $participantsId = explode(":", $request->participants);
        array_pop($participantsId);

        //provera ako je neko od ucesnika zauzet

        foreach($participantsId as $curr){

            $tmp = EmployeeModel::find($curr);
            $tmpMeetings = $tmp->meetings;
            

            foreach($tmpMeetings as $tmpMeeting){
                
                if(($timeFrom->gt($tmpMeeting->timeFrom) || $timeFrom->eq($tmpMeeting->timeFrom)) && $timeFrom->lt($tmpMeeting->timeTo)){

                    return back()->with("status", "Employee with email: ". $tmp->email ." is busy at the given time.");

                }

                if($timeTo->gt($tmpMeeting->timeFrom) && ($timeTo->lt($tmpMeeting->timeTo) || $timeTo->eq($tmpMeeting->timeTo))){

                    return back()->with("status", "Employee with email: ". $tmp->email ." is busy at the given time.");

                }

                if($timeFrom->lt($tmpMeeting->timeFrom) && $timeTo->gt($tmpMeeting->timeTo)){

                    return back()->with("status", "Employee with email: ". $tmp->email ." is busy at the given time.");

                }

                if($timeFrom->eq($tmpMeeting->timeFrom) && $timeTo->eq($tmpMeeting->timeTo)){

                    return back()->with("status", "Employee with email: ". $tmp->email ." is busy at the given time.");

                }

            }

        }

        $newMeeting = MeetingModel::create([
            'title' => $request->title,
            'timeFrom' => $timeFrom,
            'timeTo' => $timeTo,
            'status' => 'U',
            'idemployee' => auth()->user()->idemployee
        ]);

        foreach($participantsId as $curr){
            $newMeeting->participants()->attach($curr, ['status' => 'N']);
        }
           
        return redirect()->route('allMeetings');
    }

    /**
     * Funkcija za submit-ovanje podataka koji su potrebni da bi se azuriralo prisustvo na sastanku.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */

    public function updateAttendanceSubmit(Request $request){

        $meeting = MeetingModel::where('idmeeting', $request->idmeeting)->get();
        $input = $request->all();

        foreach($meeting[0]->participants as $participant){

            $tmpKey = "e".$participant->idemployee;
            if(array_key_exists($tmpKey, $input)){
                
                AttendanceModel::where('idmeeting', $request->idmeeting)
                                ->where('idemployee', $participant->idemployee)
                                ->update(['status' => 'Y']);

            }
            else{

                AttendanceModel::where('idmeeting', $request->idmeeting)
                                ->where('idemployee', $participant->idemployee)
                                ->update(['status' => 'N']);

            }

        }

        return redirect()->route('allMeetings');

    }

    /**
     * Funkcija za submit-ovanje podataka koji su potrebni da bi se azurirao sastanak.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */

    public function updateMeetingSubmit(Request $request){
        
        $timeFrom = new Carbon($request->meetdate);
        $timeFrom->hour = explode(":", $request->timeFrom)[0];
        $timeFrom->minute = explode(":", $request->timeFrom)[1];

        $timeTo = new Carbon($request->meetdate);
        $timeTo->hour = explode(":", $request->timeTo)[0];
        $timeTo->minute = explode(":", $request->timeTo)[1];

        $participantsId = explode(":", $request->participants);
        array_pop($participantsId);

        $idmeeting = $request->idmeeting;

        //provera ako je neko od ucesnika zauzet

        foreach($participantsId as $curr){
            
            $tmp = EmployeeModel::find($curr);
            $tmpMeetings = $tmp->meetings;
            

            foreach($tmpMeetings as $tmpMeeting){

                if($tmpMeeting->idmeeting == $idmeeting) continue;  //preskacemo sastanak koji se azurira trenutno

                if(($timeFrom->gt($tmpMeeting->timeFrom) || $timeFrom->eq($tmpMeeting->timeFrom)) && $timeFrom->lt($tmpMeeting->timeTo)){

                    return back()->with("status", "Employee with email: ". $tmp->email ." is busy at the given time.");

                }

                if($timeTo->gt($tmpMeeting->timeFrom) && ($timeTo->lt($tmpMeeting->timeTo) || $timeTo->eq($tmpMeeting->timeTo))){

                    return back()->with("status", "Employee with email: ". $tmp->email ." is busy at the given time.");

                }

                if($timeFrom->lt($tmpMeeting->timeFrom) && $timeTo->gt($tmpMeeting->timeTo)){

                    return back()->with("status", "Employee with email: ". $tmp->email ." is busy at the given time.");

                }

                if($timeFrom->eq($tmpMeeting->timeFrom) && $timeTo->eq($tmpMeeting->timeTo)){

                    return back()->with("status", "Employee with email: ". $tmp->email ." is busy at the given time.");

                }

            }

        }

        $myMeeting = MeetingModel::where('idmeeting', $request->idmeeting)->get();
        

        $myMeeting[0]->update([
            'title' => $request->title,
            'timeFrom' => $timeFrom,
            'timeTo' => $timeTo,
            'status' => 'U',
            'idemployee' => auth()->user()->idemployee
        ]);

        $myMeeting[0]->participants()->detach();

        foreach($participantsId as $curr){
            $myMeeting[0]->participants()->attach($curr, ['status' => 'N']);
        }

        return redirect()->route('allMeetings');
    }


    /**
     * Funkcija za brisanje sastanka.
     * 
     * @param int $id sastanka
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function deleteMeeting($id){

        MeetingModel::where('idmeeting', $id)->delete();
        return redirect()->route('allMeetings');

    }

    /**
     * Funkcija za dohvatanje zaposlenih koji imaju email slican unetom prilikom pretrage zaposlenih za dodavanje na sastanak.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function employeeSearch(Request $request){
        
        $employees = null;

        if($request->keyword != ''){

            $employees = EmployeeModel::where('email','LIKE','%'.$request->keyword.'%')->get();
            
        }
        return response()->json([
           'employees' => $employees
        ]);
    }

    /**
     * Funkcija za dohvatanje zaposlenog na osnovu email - a koji se upravo dodaje na sastanak.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmployee(Request $request){
        
        $employee = EmployeeModel::where('email', $request->email)->get();
            
        return response()->json([
           'employee' => $employee[0]
        ]);

    }
}