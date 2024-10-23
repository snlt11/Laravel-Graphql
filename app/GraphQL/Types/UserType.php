<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'User type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'User id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User name'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User email'
            ],
            'position' => [
                'type' => Type::string(),
                'description' => 'User position'
            ],
            'salary' => [
                'type' => Type::string(),
                'description' => 'User Salary'
            ],
            'role' => [
                'type' => Type::string(),
                'description' => 'User Role'
            ],
            'department' => [
                'type' => Type::string(),
                'description' => 'User Department'
            ],
            'date_of_birth' => [
                'type' => Type::string(),
                'description' => 'User Date of Birth'
            ],
            'nrc' => [
                'type' => Type::string(),
                'description' => 'User National Registration Card'
            ],
            'address' => [
                'type' => Type::string(),
                'description' => 'User Address'
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'User Phone'
            ],
            'gender' => [
                'type' => Type::string(),
                'description' => 'User Gender'
            ],
            'skills' => [
                'type' => Type::string(),
                'description' => 'User Skills'
            ],
            'emergency_contact' => [
                'type' => Type::string(),
                'description' => 'User Emergency Contact'
            ],
            'emergency_contact_number' => [
                'type' => Type::string(),
                'description' => 'User Emergency Contact Number'
            ],
            'joining_date' => [
                'type' => Type::string(),
                'description' => 'User Joining Date'
            ],
            'system_status' => [
                'type' => Type::string(),
                'description' => 'User System Status'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'User created at'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'User updated at'
            ],
            'deleted_at' => [
                'type' => Type::string(),
                'description' => 'User deleted at'
            ],
        ];
    }
}
