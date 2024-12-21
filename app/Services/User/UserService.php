<?php
namespace App\Services\User;

use App\Repository\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Repository\Role\RoleRepositoryInterface;

class UserService{

    private UserRepositoryInterface $userRepo;
    private RoleRepositoryInterface $roleRepo;

    public function __construct(UserRepositoryInterface $userRepo, RoleRepositoryInterface $roleRepo){
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    public function index(Request $request){
        return $this->userRepo->index($request->all());
    }

    public function assignRole(array $data){
        $this->userRepo->assignRole($data);
    }

    public function getRoles(){
        return $this->roleRepo->getRoles();
    }

}