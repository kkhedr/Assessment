<?php

namespace App\Repository\Auth;


interface AuthRepositoryInterface{
    public function login($email, $password);
}