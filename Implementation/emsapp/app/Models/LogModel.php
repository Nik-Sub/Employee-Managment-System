<?php
//Created by Uros Kozic 2020-0267
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * LogModel - klasa koja omogucava rad sa tabelom iz baze
 */
class LogModel extends Model
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
        'idemployee', 'firstName', 'lastName', 'birthday', 'department', 'email', 'password', 'idrole'
    ];

    
}
