<?php

namespace App\GraphQL\Queries\Quest;

use App\Models\Quest;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;


class QuestsQuery extends Query
{
    protected $attributes = [
        'name' => 'quests',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Quest'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $query = Quest::query();

        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }

        if (isset($args['title'])) {
            $query->where('title', 'like', '%' . $args['title'] . '%');
        }

        return $query->get();
    }
}