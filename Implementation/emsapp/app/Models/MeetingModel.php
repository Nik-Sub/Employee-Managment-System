<?php
//Created by Ivan Šobić 2020/0072
//Updated by Boris Martinovic 2020/0582


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
/**
 * MeetingModel - klasa koja mapira tabelu meeting iz baze emsdb (preko Eloquent ORM).
 * @version 1.0
 */
class MeetingModel extends Model
{
    use HasFactory;

    /**
    * @var string $table
    */
    protected $table = 'meeting';

    /**
    * @var string $primaryKey
    */
    protected $primaryKey = 'idmeeting';

    /**
    * @var bool $timestamps
    */
    public $timestamps = false;
    
    /**
    * @var string[] $fillable
    */
    protected $fillable = [
        'title', 'timeFrom', 'timeTo', 'status', 'idemployee'
    ];

    /**
    * Funkcija za definisanje many-to-many relacije. Vraca sve ucesnike sastanka.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function participants(){

        return $this->belongsToMany(EmployeeModel::class, 'attendance', 'idmeeting', 'idemployee');
    
    }

    /** 
    * Funkcija koja vraca status prisustva mitingu ulogovanog korisnika kao string.
    *
    * @return string
    */
    public function getAttendanceStatus()
    {

        $attendances = AttendanceModel::where('idmeeting', $this->idmeeting)->get();
        $a = null;
        foreach($attendances as $attendance){
            if($attendance->idemployee == auth()->user()->idemployee){
                $a = $attendance;
                break;
            } 
        }
        if($a == null){
            return "A";
        }
        else{
            return $a->status;
        }
    }

    /** 
    * Funkcija koja vraca vreme pocetka mitinga u formatu hh:mm
    *
    * @return string
    */
    public function getTimeFrom()
    {

        $carbonDate = Carbon::parse($this->timeFrom);

        $time = $carbonDate->format('H:i');

        return $time;
    }

    /** 
    * Funkcija koja vraca vreme kraja mitinga u formatu hh:mm
    *
    * @return string
    */
    public function getTimeTo()
    {

        $carbonDate = Carbon::parse($this->timeTo);

        $time = $carbonDate->format('H:i');

        return $time;
    }

    /** 
    * Funkcija koja vraca datum odrzavanja mitinga u formatu dan(dvocifreni broj) mesec(skracenica meseca na engleskom) godina(cetvorocifren broj).
    *
    * @return string
    */
    public function getDate()
    {
        $carbonDate = Carbon::parse($this->timeTo);

        $date = $carbonDate->format('d M Y');

        return $date;
    }

    /** 
    * Funkcija koja ime i prezime organizatora mitinga.
    *
    * @return string
    */
    public function getOrganizerFullName()
    {
        $organizer = EmployeeModel::find($this->idemployee);

        return $organizer->firstName . ' ' . $organizer->lastName;
    }

}
