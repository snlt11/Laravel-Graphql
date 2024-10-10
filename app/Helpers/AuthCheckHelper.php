<?php

namespace App\Helpers;

use Exception;
use App\Models\User;

class AuthCheckHelper
{
    public static function canDeleteUser(User $user)
    {
        $authUser = auth()->user();

        if ($user->role === 'admin' && $user->id == $authUser->id) {
            throw new Exception('You cannot delete admin account');
        }
        if ($authUser->role !== 'admin') {
            throw new Exception('Only admin users can delete accounts');
        }
    }
    public static function canCreateOrUpdateUser()
    {
        $authUser = auth()->user();

        if ($authUser->role !== 'admin') {
            throw new Exception('Only admin users can create or update accounts.');
        }
    }
}
