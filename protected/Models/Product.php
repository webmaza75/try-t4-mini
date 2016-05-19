<?php

namespace App\Models;

use T4\Orm\Model;

class Product extends Model
{
    static protected $schema = [
        'table' => 'products',
        'columns' => [
            'title' => ['type' => 'string'],
            'price' => ['type' => 'int'],
            'stock' => ['type' => 'bool'],
        ],
        'relations' => [
            'category' => ['type' => self::BELONGS_TO, 'model' => Category::class],
        ],
    ];
}