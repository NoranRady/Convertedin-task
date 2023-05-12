<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function getTasks(int $perPage = 10)
    {
        return Task::with(['assignedTo', 'assignedBy'])->paginate($perPage);
    }

    public function createTask($title, $description, $assignedToId, $assignedById) : Task
    {
        $task = new Task();
        $task->title = $title;
        $task->description = $description;
        $task->assigned_to_id = $assignedToId;
        $task->assigned_by_id = $assignedById;
        $task->save();
        return $task;
    }
}