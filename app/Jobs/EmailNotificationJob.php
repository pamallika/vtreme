<?php

namespace App\Jobs;

use App\Http\Controllers\UserController;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EmailNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $group;

    /**
     * Create a new job instance.
     */
    public function __construct(GroupUser $groupUser)
    {
        /** @var User $user */
        $this->user = User::findOrFail($groupUser->getUserId());
        /** @var Group $group */
        $this->group = Group::findOrFail($groupUser->getGroupId());
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        UserController::sendExpiredMail($this->user->getName(), $this->group->getName(), $this->user->getEmail());
    }
}
