<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'A product category'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the category',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the category',
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of the category',
            ],
        ];
    }
}
