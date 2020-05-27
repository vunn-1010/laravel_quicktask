<?php

namespace App\Repositories;

use App\User;

class TaskRepository
{

    /**
     * Get all of tasks for the given user
     * 
     * @param User $user
     * 
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->tasks()->orderBy('created_at', 'desc')->get();
    }
}
