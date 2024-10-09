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
                'type'=> Type::nonNull(Type::string()),
                'description'=> 'User position'
            ],
            'salary' => [
                'type'=> Type::nonNull(Type::string()),
                'description'=> 'User Salary'
            ],
            'role' => [
                'type'=> Type::nonNull(Type::string()),
                'description'=> 'User Role'
            ]

        ];
    }
}
