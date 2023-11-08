<?php

namespace App\Console\Commands;

use App\Http\Controllers\GroupUserController;
use Illuminate\Console\Command;

class UserCheckExpiration extends Command
{

    protected $signature = 'user:check_expiration';

    protected $description = 'всех пользователей исключить из групп, у которых expired_at меньше текущего момента времени';

    public function handle()
    {
        GroupUserController::refreshUsers();
    }
}
