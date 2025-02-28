<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use Exception;
use App\Models\User;
use App\Helpers\AuthCheckHelper;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Illuminate\Support\Facades\Validator;
use Rebing\GraphQL\Error\ValidationError;
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
            'id' => ['required'],
            'name' => ['nullable'],
            'email' => ['nullable', 'email'],
            'position' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'string'],
            'role' => ['nullable', 'in:admin,user'],
            'password' => ['nullable', 'string', 'min:8'],
            'department' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'string'],
            'nrc' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'gender' => ['nullable', 'string'],
            'skills' => ['nullable', 'string'],
            'emergency_contact' => ['nullable', 'string'],
            'emergency_contact_number' => ['nullable', 'string'],
            'joining_date' => ['nullable', 'string'],
            'system_status' => ['nullable'],
        ];
    }
    public function messages(): array
    {
        return [
            'id.required' => 'User ID is required.',
            'email.email' => 'User Email must be a valid email address.',
            'position.string' => 'User Position must be a string.',
            'position.max' => 'User Position cannot exceed 255 characters.',
            'role.in' => 'User Role must be either admin or user.',
            'password.string' => 'User Password must be a string.',
            'password.min' => 'User Password must be at least 8 characters long.',
            'department.string' => 'User Department must be a string.',
            'department.max' => 'User Department cannot exceed 255 characters.',
            'address.string' => 'User Address must be a string.',
            'skills.string' => 'User Skills must be a string.',
            'emergency_contact.string' => 'User Emergency Contact must be a string.',
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $validator = Validator::make($args, $this->rules(), $this->messages());
        if ($validator->fails()) {
            throw new ValidationError('Validation failed', $validator);
        }
        AuthCheckHelper::canCreateOrUpdateUser();

        $user = User::findOrFail($args['id']);
        if ($user->system_status !== 'active') {
            throw new Exception('User system status is not active.');
        }
        $user->update($args);
        return $user;
    }
}
