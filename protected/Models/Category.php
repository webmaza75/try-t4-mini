<?php

namespace App\Models;

use T4\Orm\Model;
use T4\Core\Exception;

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

    protected function validateTitle($val) {
        if (!preg_match('~[a-zа-я]~i', $val)) {
            yield new Exception('Некорректные символы для названия');
        }
        if (strlen($val) < 3) {
            yield new Exception('Слишком короткое название');
        }
        return true;
    }

    protected function sanitizeTitle($val) {
        return preg_replace('~\s+~', ' ', $val);
    }

    public function afterDelete()
    {
        foreach ($this->products as $product) {
            $product->delete();
        }
    }
}