<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\UserRepository;
use PhpParser\Node\Expr\Cast\Bool_;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers($isAdmin )
    {
        return $this->userRepository->getUsers($isAdmin);
    }

}