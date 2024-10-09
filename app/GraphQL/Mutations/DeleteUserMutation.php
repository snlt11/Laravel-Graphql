<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class DeleteUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteUser',
        'description' => 'Delete User mutation'
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::id()), 'description' => 'User ID'],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $user = User::findOrFail($args['id']);
        $user->delete();
        return 'User deleted successfully';

        // user can delete but need to fix
        // if ($user->role === 'admin' && $user->id == auth()->id()) {
        //     $user->delete();
        //     return 'User deleted successfully';
        // }
        // return null;
    }
}
