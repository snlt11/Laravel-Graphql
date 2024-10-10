<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Helpers\AuthCheckHelper;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUser',
        'description' => 'Create User Mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'name' => ['type' => Type::nonNull(Type::string()), 'description' => 'User Name'],
            'email' => ['type' => Type::nonNull(Type::string()), 'description' => 'User Email'],
            'position' => ['type' => Type::string(), 'description' => 'User Position'],
            'salary' => ['type' => Type::string(), 'description' => 'User Salary'],
            'password' => ['type' => Type::nonNull(Type::string()), 'description' => 'User Password'],
        ];
    }
    public function rules(array $args = []): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'position' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function resolve(array $args,)
    {
        AuthCheckHelper::canCreateOrUpdateUser();
        return User::create($args);
    }
}
