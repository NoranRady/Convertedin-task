<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Jobs\UpdateStatistics;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;

class TaskController extends Controller
{

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $tasks = $this->taskService->getTasks($perPage);
        return response()->json($tasks);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {
        $this->taskService->createTask($request->validated());
         // Dispatch the UpdateStatistics job
        UpdateStatistics::dispatch($request->validated()['assigned_to']);
        return response()->json(['message' => 'Task created successfully.']);
    }
}
