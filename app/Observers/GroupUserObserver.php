<?php

namespace App\Observers;

use App\Jobs\CheckActiveUserJob;
use App\Jobs\EmailNotificationJob;
use App\Models\Group;
use App\Models\GroupUser;
use Carbon\Carbon;

class GroupUserObserver
{
    /**
     * Handle the GroupUser "created" event.
     */
    public function created(GroupUser $groupUser): void
    {
        /** @var Group $group */
        $group =  Group::find($groupUser->getGroupId());
        $expire = Carbon::now()->addHours($group->getExpireHours());
        $groupUser->update(['expired_at' => $expire->format('Y-m-d H:i:s')]);

    }

    /**
     * Handle the GroupUser "updated" event.
     */
    public function updated(GroupUser $groupUser): void
    {
        //
    }

    /**
     * Handle the GroupUser "deleted" event.
     */
    public function deleted(GroupUser $groupUser): void
    {
        EmailNotificationJob::dispatch($groupUser);
        CheckActiveUserJob::dispatch($groupUser);
    }

    /**
     * Handle the GroupUser "restored" event.
     */
    public function restored(GroupUser $groupUser): void
    {
        EmailNotificationJob::dispatch($groupUser);
        CheckActiveUserJob::dispatch($groupUser);
    }

    /**
     * Handle the GroupUser "force deleted" event.
     */
    public function forceDeleted(GroupUser $groupUser): void
    {
        EmailNotificationJob::dispatch($groupUser);
        CheckActiveUserJob::dispatch($groupUser);
    }
}
