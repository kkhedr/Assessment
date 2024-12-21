<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Requests\User\AssignRoleRequest;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service){
        $this->service = $service;
        $this->middleware('permission:view-user')->only(['index']);
        $this->middleware('permission:assign-role')->only(['assignRole']);
    }

    public function index(Request $request){
        $users = $this->service->index($request);
        $roles = $this->service->getRoles();
        return view('dashboard.user.index', compact('users', 'roles'));
    }

    public function assignRole(AssignRoleRequest $request){
        $this->service->assignRole($request->validated());
        return redirect('/users')->with(['success' => __('messages.role_added')]); 
    }

}
