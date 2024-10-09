<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;

class LogoutMutation extends Mutation
{
    protected $attributes = [
        'name' => 'logout',
        'description' => 'Logout User mutation'
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = Auth::user();
        if ($user) {
            $user->token()->revoke();
            return 'Logged out successfully';
        }
        return 'User not authenticated';
    }
}
