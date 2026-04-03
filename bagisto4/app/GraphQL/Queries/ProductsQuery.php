<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Webkul\Product\Models\ProductFlat;

class ProductsQuery extends Query
{
    protected $attributes = [
        'name' => 'products',
        'description' => 'Get products with optional filters'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Product'));
    }

    public function args(): array
    {
        return [
            'limit' => [
                'type' => Type::int(),
                'description' => 'Limit the number of products',
                'defaultValue' => 10
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Filter products by name (contains)',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $query = ProductFlat::query();

        // Filter by name if provided
        if (isset($args['name'])) {
            $query->where('name', 'like', '%' . $args['name'] . '%');
        }

        // Apply limit
        $query->limit($args['limit']);

        // Order by newest first
        $query->orderBy('created_at', 'desc');

        return $query->get();
    }
}
