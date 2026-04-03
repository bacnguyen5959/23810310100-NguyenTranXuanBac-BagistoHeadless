<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Product',
        'description' => 'A product in the store'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the product',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the product',
            ],
            'price' => [
                'type' => Type::float(),
                'description' => 'The price of the product',
                'resolve' => function ($product) {
                    return (float) (is_array($product) ? $product['price'] : $product->price);
                }
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'The description of the product',
            ],
            'url_key' => [
                'type' => Type::string(),
                'description' => 'The URL key of the product',
            ],
        ];
    }
}
