<?php

namespace App\Jobs;

use App\Models\Statistic;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $assignedToId;

    /**
     * Create a new job instance.
     */
    public function __construct($assignedToId)
    {
        $this->assignedToId = $assignedToId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Statistic::updateOrInsert(
            ['user_id' => $this->assignedToId], // the search criteria
            ['task_count' => DB::raw('task_count + 1')] // the update values
        );
    }
}
