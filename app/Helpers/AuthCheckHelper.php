<?php

namespace App\Helpers;

use App\Models\User;

class AuthCheckHelper
{
    public static function canDeleteUser(User $user){
        $authUser = auth()->user();

        if ($user->role === 'admin' && $user->id == $authUser->id) {
            return 'You cannot delete admin account';
        }
        if ($authUser->role !== 'admin') {
            return 'Only admin users can delete accounts';
        }
        return null;
    }
}
