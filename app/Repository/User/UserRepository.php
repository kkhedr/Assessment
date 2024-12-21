<?php
namespace App\Repository\User;
use App\Models\User;
use App\Helper\Helper;

class UserRepository implements UserRepositoryInterface{

    private User $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(array $request){
        return $this->user->paginate(isset($request['per_page']) ? $request['per_page']  : Helper::PAGINATE);
    }

    public function assignRole(array $data){
        $role = $this->user->getRole($data['role_id']);
        foreach($data['user_ids'] as $user_id){
            $user = $this->user->findOrFail($user_id);
            $user->roles()->delete();
            $user->assignRole($role);
        }
    }
    
}