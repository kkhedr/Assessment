<?php

namespace App\Repository\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface{

    private User $user;
    public function __construct(User $user){
        $this->user = $user;
    }

    public function login($email, $password){
        if(Auth::attempt(['email' => $email, 'password' => $password])){ 
            $user = Auth::user();
            return $user;
        } 
        return null;
    }
}