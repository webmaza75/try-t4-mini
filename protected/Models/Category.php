<?php

namespace App\Models;

use T4\Orm\Model;

/**
 * Class Category схема для таблицы категорий (categories)
 * Тип связи: в 1 категории много продуктов (self::HAS_MANY)
 * @package App\Models
 */
class Category extends Model
{
    static protected $schema = [
        'table' => 'categories',
        'columns' => [
            'title' => ['type' => 'string'],
        ],
        'relations' => [
            'products' => ['type' => self::HAS_MANY, 'model' => Product::class],
        ],
    ];

    static protected $extensions = ['tree'];
}