<?php
namespace App\Services\Auth;

use Illuminate\Http\Request;
use App\Repository\Auth\AuthRepositoryInterface;


class AuthService{
    private AuthRepositoryInterface $auth;
   

    public function __construct(AuthRepositoryInterface $auth){
        $this->auth = $auth;
    }

    public function login($email, $password){
        return  $this->auth->login($email, $password);
    }



    
}