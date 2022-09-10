<?php

namespace App\graphql\Mutations;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateUserMutation extends Mutation
{
    protected $attributes = [
        "name" => "updateUser",
    ];
    public function type(): Type
    {
        return GraphQL::type("User");
    }
    public function args(): array
    {
        return [
            "id" => [
                "name" => "id",
                "type" => Type::int(),
                "rules" => ["required"],
            ],
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
        $user = User::findOrFail($args["id"]);
        $user->fill($args);
        $user->save();
        return $user;
    }
}
