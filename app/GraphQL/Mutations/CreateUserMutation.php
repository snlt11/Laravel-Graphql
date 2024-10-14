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
            'role' => ['type' => Type::string(), 'description' => 'User Role'],
            'password' => ['type' => Type::nonNull(Type::string()), 'description' => 'User Password'],
            'department' => ['type' => Type::string(), 'description' => 'User Department'],
            'date_of_birth' => ['type' => Type::string(), 'description' => 'User Date of Birth'],
            'nrc' => ['type' => Type::string(), 'description' => 'User NRC'],
            'address' => ['type' => Type::string(), 'description' => 'User Address'],
            'phone' => ['type' => Type::string(), 'description' => 'User Phone'],
            'gender' => ['type' => Type::string(), 'description' => 'User Gender'],
            'skills' => ['type' => Type::string(), 'description' => 'User Skills'],
            'emergency_contact' => ['type' => Type::string(), 'description' => 'User Emergency Contact'],
            'emergency_contact_number' => ['type' => Type::string(), 'description' => 'User Emergency Contact Number'],
            'joining_date' => ['type' => Type::string(), 'description' => 'User Joining Date'],
            'system_status' => ['type' => Type::string(), 'description' => 'User System Status'],
        ];
    }
    public function rules(array $args = []): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'position' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable'],
            'role' => ['nullable', 'in:admin,user'],
            'password' => ['required', 'string', 'min:8'],
            'department' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'string'],
            'nrc' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'gender' => ['nullable', 'in:male,female,other'],
            'skills' => ['nullable', 'string'],
            'emergency_contact' => ['nullable', 'string'],
            'emergency_contact_number' => ['nullable', 'string'],
            'joining_date' => ['nullable', 'string'],
            'system_status' => ['nullable', 'in:active,inactive,deleted'],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        AuthCheckHelper::canCreateOrUpdateUser();
        return User::create($args);
    }
}
