<?php

namespace App\Http\Controllers\Api;

use App\Services\StatisticService;
use App\Http\Controllers\Controller;

class StatisticController extends Controller
{
    protected $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    public function getTopUsersWithTaskCounts($count)
    {
        $users = $this->statisticService->getTopUsersWithTaskCounts($count);
        return response()->json($users);
    }
}