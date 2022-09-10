<?php

namespace App\graphql\Mutations;

use App\Models\User;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        "name" => "createUser",
    ];
    public function type(): Type
    {
        return GraphQL::type("User");
    }
    public function args(): array
    {
        return [
            "name" => [
                "name" => "name",
                "type" => Type::string(),
                "rules" => ["required"],
            ],
            "email" => [
                "name" => "email",
                "type" => Type::string(),
                "rules" => ["required"],
            ],
            "password" => [
                "name" => "password",
                "type" => Type::string(),
                "rules" => ["required"],
            ],
        ];
    }
    public function resolve($root, $args)
    {
        $user = new User();
        $user->fill($args);
        $user->save();
        return $user;
    }
}
