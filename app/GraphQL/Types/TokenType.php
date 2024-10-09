<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TokenType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Token',
        'description' => 'Token type'
    ];

    public function fields(): array
    {
        return [
            'message' => [
                'type' => Type::string(),
                'description' => 'Response message'
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'The access token of the user'
            ],
            'status_code' => [
                'type' => Type::INT(),
                'description' => 'Status code of the response'
            ],
        ];
    }
}
