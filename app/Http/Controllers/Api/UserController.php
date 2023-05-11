<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetUsersRequest;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(GetUsersRequest $request)
    {
        $users = $this->userService->getUsers($request->input('is_admin'));
        return response()->json($users);
    }

}
