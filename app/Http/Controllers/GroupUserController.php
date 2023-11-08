<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GroupUserController extends Controller
{
    public static function addUserInGroup(int $userId, int $groupId)
    {
        /** @var User $user */
        $user = User::findOrFail($userId);
        /** @var Group $group */
        $group = Group::findOrFail($groupId);

        if ($user->getActive()) {
            GroupUser::create(['user_id' => $user->getId(), 'group_id' => $group->getId()]);

            return true;
        }

        DB::transaction(function () use ($userId, $groupId) {
            GroupUser::create(['user_id' => $userId, 'group_id' => $groupId]);
            $user = User::find($userId);
            $user->update(['active' => true]);
        });

        return true;
    }

    public static function refreshUsers(): bool
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        /** При массовом удалении observer не увидит изменений, поэтому оставьте так **/
        foreach (GroupUser::where('expired_at', '<', $now)->where('expired_at', '!=', null)->get() as $expiredUser) {
            $expiredUser->delete();
        }

        return true;
    }
}
