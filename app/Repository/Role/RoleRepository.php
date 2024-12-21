<?php
namespace App\Repository\Role;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface{

    private Role $role;

    public function __construct(Role $role){
        $this->role = $role;
    }

    public function getRoles(){
        return $this->role->get(['id', 'name']);
    }

}