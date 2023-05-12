<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\JsonResponse;
use App\Services\StatisticService;
use App\Repositories\StatisticRepository;
use App\Http\Controllers\Api\StatisticController;

class StatisticControllerTest extends TestCase
{
    public function testGetTopUsersWithTaskCounts()
    {
        $count = 1;
        $controller = new StatisticController(new StatisticService(new StatisticRepository()));        
        $response = $controller->getTopUsersWithTaskCounts($count);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertEquals([
            [
                "user_name" => "user 1",
                "task_count"=> 2
            ]] ,json_decode($response->getContent(), true));
    }
}