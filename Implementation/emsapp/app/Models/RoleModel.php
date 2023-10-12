<?php
// Created by Nikola Šubarić 2020/0271
// Updated by Uros Kozic 2020/0267 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * RoleModel - klasa koja omogucava rad sa tabelom iz baze
 */
class RoleModel extends Model
{
    use HasFactory;
    /**
    * @var string $table
    */
    protected $table = 'role';

    /**
    * @var string $primaryKey
    */
    protected $primaryKey = 'idrole';

    /**
    * @var bool $timestamps
    */
    public $timestamps = false;


    /**
    * @var string[] $fillable
    */
    protected $fillable = [
        'idrole', 'name'
    ];

    /**
    * Funkcija koja vraca sve role.
    *
    * @return \Illuminate\Database\Eloquent\Collection|static[]
    */
    public function roles(){
        return $this->all();
    }
}
