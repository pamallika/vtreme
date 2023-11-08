<?php

namespace App\Jobs;

use App\Http\Controllers\UserController;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckActiveUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private User $user;

    /**
     * Create a new job instance.
     */
    public function __construct(GroupUser $groupUser)
    {
        $this->user = User::findOrFail($groupUser->getUserId());
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (count($this->user->groups) < 1) {
            UserController::deactivateUser($this->user);
        }
    }
}
