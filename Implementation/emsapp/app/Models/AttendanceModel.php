<?php
//Created by Boris Martinovic 2020/0582

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * AttendanceModel - klasa koja mapira tabelu attendance iz baze emsdb (preko Eloquent ORM).
 * @version 1.0
 */

class AttendanceModel extends Model
{
    use HasFactory;


    /**
    * @var string $table
    */
    protected $table = 'attendance';

    /**
    * @var bool $timestamps
    */
    public $timestamps = false;

    /**
    * @var string[] $fillable
    */
    protected $fillable = [
        'idemployee', 'idmeeting', 'status'
    ];

}
