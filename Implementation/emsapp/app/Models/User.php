<?php
//Updated by Uros Kozic 2020-0267
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
    * @var string $table
    */
    protected $table ='employee';

    /**
    * @var string $primaryKey
    */
    protected $primaryKey = 'idemployee';

    /**
    * @var string[] $fillable
    */
    protected $fillable = [
        'idemployee', 'firstName','lastName','birthday','department','email' ,'password','idrole'
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword(){
        return $this->password;
    }

    
}
