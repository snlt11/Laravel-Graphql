<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users',
        'description' => 'User With Pagination'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('User');
    }

    public function args(): array
    {
        return [
            'page' => [
                'type' => Type::int(),
                'description' => 'Page number for pagination',
                'defaultValue' => 1
            ],
            'limit' => [
                'type' => Type::int(),
                'description' => 'Number of users per page',
                'defaultValue' => 5
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return User::paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}
