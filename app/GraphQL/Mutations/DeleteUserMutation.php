<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Helpers\AuthCheckHelper;
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

        $user = User::withTrashed()->findOrFail($args['id']);
        AuthCheckHelper::canDeleteUser($user);
        $user->delete();
        return 'User deleted successfully';
    }
}
