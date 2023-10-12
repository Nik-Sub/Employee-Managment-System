<?php
//Created by Uros Kozic 2020-0267

namespace App\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use \Illuminate\Contracts\Auth\Authenticatable;
use App\Models\AutorModel;
use App\Models\User;

class AutorModelProvider implements UserProvider{

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier){
        return User::where('idemployee', $identifier)->first();
    }

  
    public function retrieveByToken($identifier, $token){}

   
    public function updateRememberToken(Authenticatable $user, $token){}

    /**
     * vraca korisnika za date kredencijale
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials){
        return User::where('email', $credentials['email'])->first();
    }

    /**
     * proverava da li odgovaraju kredencijali za korisnika($user)
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials){
        return $user->getAuthPassword() == $credentials['password'];
    }

}