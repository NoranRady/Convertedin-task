<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService
{

    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getTasks(int $perPage)
    {
        return $this->taskRepository->getTasks($perPage);
    }
    
    public function createTask(array $data, $assignedById) : Task
    {
        $savedTask = $this->taskRepository->createTask($data['title'], $data['description'], $data['assigned_to'], $assignedById);
        return $savedTask;
    }
}