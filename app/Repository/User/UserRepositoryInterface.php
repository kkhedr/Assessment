<?php
namespace App\Repository\User;

interface UserRepositoryInterface{
    public function index(array $request);
    public function assignRole(array $data);
}