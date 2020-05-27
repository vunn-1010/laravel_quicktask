<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine of given task can be deleted by the user
     * 
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
