<?php
//Created by Nikola Šubarić 2020/0271
//Updated by Ivan Šobić 2020/0072

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * EmployeeModel - klasa koja mapira tabelu employee iz baze emsdb (preko Eloquent ORM).
 * @version 1.0
 */
class EmployeeModel extends Model
{
    use HasFactory;

    /**
    * @var string $table
    */
    protected $table = 'employee';

    /**
    * @var string $primaryKey
    */
    protected $primaryKey = 'idemployee';

    /**
    * @var bool $timestamps
    */
    public $timestamps = false;
    
    /**
    * @var string[] $fillable
    */
    protected $fillable = [
        'idemployee', 'firstName', 'lastName', 'birthday', 'department', 'email', 'password', 'idrole', 'picture'
    ];

    /**
    * Funkcija za definisanje many-to-many relacije. Vraca sve mitinge na kojim ucestvuje ili je ucestvovao zaposleni.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function meetings(){

        return $this->belongsToMany(MeetingModel::class, 'attendance', 'idemployee', 'idmeeting');
    
    }

    /**
    * Funkcija za definisanje one-to-many relacije. Vraca sve mitinge ciji je employee vlasnik.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function myMeetings(){
        return $this->hasMany(MeetingModel::class, 'idemployee', 'idemployee');
    }

    /**
    * Funkcija koja vraca naziv role ciji idrole ima employee.
    *
    * @return string
    */
    public function getRoleName()
    {
        $role = RoleModel::find($this->idrole);

        return $role->name;

    }

    /** 
    * Funkcija koja vraca datum rodjenja u formatu dan(dvocifreni broj) mesec(skracenica meseca na engleskom) godina(cetvorocifren broj).
    *
    * @return string
    */
    public function getBirthday()
    {
        $carbonBirthday = Carbon::parse($this->birthday);

        return $carbonBirthday->format('d M Y');
    }

    
}
