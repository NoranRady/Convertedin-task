<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Jobs\UpdateStatistics;
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
    
    public function createTask(array $data) : Task
    {
        $savedTask = $this->taskRepository->createTask($data['title'], $data['description'], $data['assigned_to'], $data['assigned_by']);
        // Dispatch the UpdateStatistics job
        UpdateStatistics::dispatch($data['assigned_to']);
        return $savedTask;
    }
}