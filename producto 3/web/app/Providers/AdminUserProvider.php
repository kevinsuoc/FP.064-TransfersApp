<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\UserProvider;

class AdminUserProvider implements UserProvider
{
    public function retrieveByCredentials(array $credentials){

    }

    public function retrieveById($identifier){

    }

    public function retrieveByToken($identifier, $token){

    }

    public function updateRememberToken(\Illuminate\Contracts\Auth\Authenticatable $user, $token){

    }

    public function validateCredentials(\Illuminate\Contracts\Auth\Authenticatable $user, array $credentials){
        
    }
}
