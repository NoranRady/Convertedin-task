<?php

namespace App\Repositories;

use App\Models\Statistic;

class StatisticRepository
{
    public function getTopUsersWithTaskCounts($count)
    {
        return Statistic::with('user')
        ->orderBy('task_count', 'desc')
        ->take(10)
        ->get()
        ->map(function($stat) {
            return [
                'user_name' => $stat->user->name,
                'task_count' => $stat->task_count,
            ];
        });
    }
}