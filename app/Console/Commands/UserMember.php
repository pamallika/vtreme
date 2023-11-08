<?php

namespace App\Console\Commands;

use App\Http\Controllers\GroupUserController;
use Illuminate\Console\Command;

class UserMember extends Command
{
    protected $signature = 'user:member';

    protected $description = 'Добавить пользователя user_id в группу group_id,если пользователь не активен (active == false), активировать его (active = true)';

    public function handle()
    {
        $userId = $this->ask('User id:');
        $groupId = $this->ask('Group id:');
        GroupUserController::addUserInGroup($userId, $groupId);
    }
}
