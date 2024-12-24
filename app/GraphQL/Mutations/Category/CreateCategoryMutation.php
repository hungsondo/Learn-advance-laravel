<?php

namespace App\GraphQL\Mutations\Category;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Validator;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createCategory',
        'description' => 'Create a new category'
    ];

    public function type(): Type
    {
        return GraphQL::type('Category');
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::string()
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $request = new CreateCategoryRequest();
        $validator = Validator::make($args, $request->rules(), $request->messages());
        if ($validator->fails()) {
            // If validation fails, throw a GraphQL error with the validation messages
            $validationErrors = $validator->errors()->all();
            throw new \GraphQL\Error\Error('Validation failed: ' . implode(', ', $validationErrors));
        }

        $category = new Category();
        $category->fill($args);
        $category->save();

        return $category;
    }
}
