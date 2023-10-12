<?php
//Created by Nikola Šubarić 2020/0271
//Updated by Ivan Šobić 2020/0072

namespace App\Http\Controllers;

use App\Models\AttendanceModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use App\Models\MeetingModel;
use Carbon\Carbon;
use Hamcrest\Arrays\IsArray;

class MeetingController extends Controller
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
    * Funkcija za prikaz sastanaka ulogovanog korisnika, sortirane po vremenu pocetka.
    * 
    * @return view
    */
    public function allMeetings()   //sastanci su sortirani po datumu odrzavanja sastanka
    {

        $idemployee = auth()->user()->idemployee;

        $currentDateTime = Carbon::now();

        MeetingModel::where('timeTo', '<', $currentDateTime)->update(['status' => 'H']);    //azuriranje statusa sastanaka
        MeetingModel::where('timeTo', '>', $currentDateTime)->update(['status' => 'U']);  

        $employee = EmployeeModel::find($idemployee);

        $meetings = [];

        switch($employee->idrole){
            case 1: //admin
                $meetings = MeetingModel::all();;
                break;
            case 2: //manager
                $organizedMeetings = MeetingModel::where('idemployee', $idemployee)->get();

                
                $idmeetings = AttendanceModel::where('idemployee', $idemployee)->pluck('idmeeting');
                if(!is_array($idmeetings)){
                    $idmeetings = $idmeetings->toArray();
                }
                $meetings = MeetingModel::whereIn('idmeeting', $idmeetings)->get();
                foreach($organizedMeetings as $meeting){
                    if(!in_array($meeting->idmeeting, $idmeetings)){
                        $meetings->push($meeting);
                    }
                }
                break;
            default:
                $idmeetings = AttendanceModel::where('idemployee', $idemployee)->pluck('idmeeting');
                $meetings = MeetingModel::whereIn('idmeeting', $idmeetings)->get();
                break;
        }

        $meetings = $meetings->sortBy('timeFrom');

        return view("meetings", ["meetings" => $meetings]);
    }
}
