<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use App\Helpers\AuthCheckHelper;
use GraphQL\Type\Definition\Type;
use App\Helpers\CustomMessageError;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Illuminate\Support\Facades\Validator;
use Rebing\GraphQL\Error\ValidationError;
use Rebing\GraphQL\Support\Facades\GraphQL;


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
    public function messages(): array
    {
        return [
            'name.required' => 'The user name is required.',
            'name.max' => 'The user name may not be greater than 255 characters.',
            'email.required' => 'The user email is required.',
            'email.email' => 'The user email must be a valid email address.',
            'email.unique' => 'The user email has already been taken.',
            'position.max' => 'The user position may not be greater than 255 characters.',
            'role.in' => 'The user role must be either admin or user.',
            'password.required' => 'The user password is required.',
            'password.min' => 'The user password must be at least 8 characters.',
            'department.max' => 'The user department may not be greater than 255 characters.',
            'gender.in' => 'The user gender must be either male, female, or other.',
            'system_status.in' => 'The user system status must be either active, inactive, or deleted.',
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
        return User::create($args);
    }
}
