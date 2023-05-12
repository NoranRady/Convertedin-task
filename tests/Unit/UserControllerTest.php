<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Repositories\UserRepository;
use App\Http\Requests\GetUsersRequest;
use App\Http\Controllers\Api\UserController;

class UserControllerTest extends TestCase
{
    public function testAdminUsersIndex()
    {
        $mockRequest = Mockery::mock(GetUsersRequest::class);
        $mockRequest->shouldReceive('input')
            ->once()
            ->with('is_admin')
            ->andReturn(true);

        $controller = new UserController(new UserService(new UserRepository()));
        $response = $controller->index($mockRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $users = json_decode($response->getContent(), true);

        foreach ($users as $user) {
            $this->assertArrayHasKey('is_admin', $user);
            $this->assertEquals(true, $user['is_admin']);
        }
    }

    public function testNonAdminUsersIndex()
    {
        $mockRequest = Mockery::mock(GetUsersRequest::class);
        $mockRequest->shouldReceive('input')
            ->once()
            ->with('is_admin')
            ->andReturn(false);

        $controller = new UserController(new UserService(new UserRepository()));
        $response = $controller->index($mockRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $users = json_decode($response->getContent(), true);

        foreach ($users as $user) {
            $this->assertArrayHasKey('is_admin', $user);
            $this->assertEquals(false, $user['is_admin']);
        }
    }
}