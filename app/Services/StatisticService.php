<?php

namespace App\Services;

use App\Repositories\StatisticRepository;

class StatisticService
{
    protected $statisticRepository;

    public function __construct(StatisticRepository $statisticRepository)
    {
        $this->statisticRepository = $statisticRepository;
    }

    public function getTopUsersWithTaskCounts($count)
    {
        return $this->statisticRepository->getTopUsersWithTaskCounts($count);
    }
}