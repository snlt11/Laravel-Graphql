<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Exports\UsersExport;
use GraphQL\Type\Definition\Type;
use Maatwebsite\Excel\Facades\Excel;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;

class UserExportMutation extends Mutation
{
    protected $attributes = [
        'name' => 'userExport',
        'description' => 'User Data Export mutation'
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $fileName = 'users_' . time() . '.xlsx';

        Excel::store(new UsersExport, 'export_file/' . $fileName);

        $fileUrl = url('/storage/' . $fileName);

        return $fileUrl;

        // return Excel::download(new UsersExport, 'users_export.xlsx');

    }
}
