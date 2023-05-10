<?php

namespace App\Repositories;

use App\Models\Statistic;

class StatisticRepository
{
    public function getTopUsersWithTaskCounts($count)
    {
        return Statistic::with('user')
            ->orderBy('task_count', 'desc')
            ->take($count)
            ->get()
            ->pluck('user');
    }
}