<?php

namespace App\Http\Controllers;

use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Mail\PendingMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public static function sendExpiredMail(string $userName, string $groupName, string $userEmail)
    {
        $mailText = 'Здравствуйте ' . $userName . '!  Истекло время вашего участия в группе ' . $groupName;
        Mail::raw($mailText, fn($mail) => $mail->to($userEmail));
    }

    public static function deactivateUser(User $user): void
    {
        $user->update(['active' => false]);
    }
}
