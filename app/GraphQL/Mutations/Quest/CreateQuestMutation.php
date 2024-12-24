<?php

namespace App\GraphQL\Mutations\Quest;

use App\Http\Requests\CreateQuestRequest;
use App\Models\Quest;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Validator;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateQuestMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createQuest',
        'description' => 'Create a new quest'
    ];

    public function type(): Type
    {
        return GraphQL::type('Quest');
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'description' => [
                'name' => 'description',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'reward' => [
                'name' => 'reward',
                'type' => Type::nonNull(Type::int()),
            ],
            'category_id' => [
                'name' => 'category_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['exists:categories,id']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        // Create an instance of the FormRequest (validation class)
        $request = new CreateQuestRequest();

        $validator = Validator::make($args, $request->rules(), $request->messages());
        if ($validator->fails()) {
            // If validation fails, throw a GraphQL error with the validation messages
            $validationErrors = $validator->errors()->all();
            throw new \GraphQL\Error\Error('Validation failed: ' . implode(', ', $validationErrors));
        }

        $quest = new Quest();
        $quest->fill($args);
        $quest->save();

        return $quest;
    }
}
