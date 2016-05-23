<?php

namespace App\Models;

use T4\Orm\Model;

/**
 * Class Product
 * Схема для сущности Продукты (products)
 * Тип связи: товар принадлежит категории (self::BELONGS_TO)
 * @package App\Models
 */
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