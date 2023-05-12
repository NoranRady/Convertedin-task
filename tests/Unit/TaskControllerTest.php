<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Repositories\TaskRepository;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Controllers\Api\TaskController;

class TaskControllerTest extends TestCase
{
    public function testIndex()
    {
        $perPage = 10;

        $mockRequest = Mockery::mock(Request::class);
        $mockRequest->shouldReceive('query')
            ->once()
            ->with('per_page', 10)
            ->andReturn($perPage);

        $controller = new TaskController(new TaskService(new TaskRepository()));
        $response = $controller->index($mockRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $tasks = json_decode($response->getContent(), true);
        $this->assertEquals(6, $tasks['total']);
    }

    public function testStore()
    {
        DB::beginTransaction();
        $requestData = [
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'assigned_to' => 1,
            'assigned_by' => 3,
        ];
        $mockRequest = Mockery::mock(CreateTaskRequest::class);
        $mockRequest->shouldReceive('validated')
            ->andReturn($requestData);

        $mockJob = Mockery::mock('overload:' . UpdateStatistics::class);
        $mockJob->shouldReceive('dispatch')
            ->once()
            ->with($requestData['assigned_to']);

        $controller = new TaskController(new TaskService(new TaskRepository()));
        $response = $controller->store($mockRequest);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertEquals(['message' => 'Task created successfully.'], json_decode($response->getContent(), true));
        DB::rollback();
    }
}