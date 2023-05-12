<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getUsers($isAdmin)
    {
        $query = User::select();

        if ($isAdmin !== null){
            $query = $query->where('is_admin', $isAdmin);
        }
        $query = $query->orderBy('name');
        return $query->get();
    }
}