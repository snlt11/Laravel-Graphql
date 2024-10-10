<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use App\Helpers\AuthCheckHelper;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateUser',
        'description' => 'Update User mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::id()), 'description' => 'User ID'],
            'name' => ['type' => Type::string(), 'description' => 'User Name'],
            'email' => ['type' => Type::string(), 'description' => 'User Email'],
            'position' => ['type' => Type::string(), 'description' => 'User Position'],
            'salary' => ['type' => Type::string(), 'description' => 'User Salary'],
        ];
    }
    public function rules(array $args = []): array
    {
        return [
            'id' => ['required'],
            'name' => ['nullable'],
            'email' => ['nullable', 'email', 'unique:users,email,' . $args['id']],
            'position' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'string'],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        AuthCheckHelper::canCreateOrUpdateUser();
        $user = User::findOrFail($args['id']);
        $user->update($args);
        return $user;
    }
}
