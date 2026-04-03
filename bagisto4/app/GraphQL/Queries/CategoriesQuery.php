<?php

namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Webkul\Category\Models\Category;

class CategoriesQuery extends Query
{
    protected $attributes = [
        'name' => 'categories',
        'description' => 'Get all categories'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Category'));
    }

    public function resolve($root, $args)
    {
        return Category::with('translations')->get();
    }
}
